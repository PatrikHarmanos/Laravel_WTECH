<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Session::flush();
        $search = $request->query('search');
        $orderBy = $request->query('orderBy');
        $orderType = $request->query('orderType');
        $price = $request->query('price');
        $selected_category = $request->query('category');

        $user = Auth::user();

        if ($search) {
            $products = Product::where('title', 'ILIKE', '%'.$search.'%')->paginate(4);
            return view('products.index')->with('products', $products)->with('category', 'Všetky produkty')->with('user', $user);
        } else if ($selected_category) {
            $category_id = ProductCategory::where('category_name', $selected_category)->first()->id;
            $products = Product::where('category_id', 'LIKE', $category_id)->paginate(4);
            return view('products.index')->with('products', $products)->with('category', $selected_category)->with('user', $user);
        } else if ($orderBy){
            $products = Product::orderBy($orderBy, $orderType)->paginate(4);
            return view('products.index')->with('products', $products)->with('category', 'Všetky produkty')->with('user', $user);
        } else if ($price) {
            if ($price == '<20')
                $products = Product::where('price', '<', 20)->paginate(4);
            else if ($price == '<50')
                $products = Product::whereBetween('price', array(20, 50))->paginate(4);
            else if ($price == '>50')
                $products = Product::where('price', '>', 50)->paginate(4);

            return view('products.index')->with('products', $products)->with('category', 'Všetky produkty')->with('user', $user);
        } else {
            $products = Product::paginate(4);
            return view('products.index')->with('products', $products)->with('category', 'Všetky produkty')->with('user', $user);
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product_categories = ProductCategory::all();
        return view('products.create', compact('product_categories', $product_categories));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);

        $newImageName = time() . '-' . $request->title . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $newImageName);

        $product = Product::create([
            'title' => $request->input('title'),
            'price' => $request->input('price'),
            'image_path' => $newImageName,
            'description' => $request->get('description'),
            'category_id' => $request->get('category_id')
        ]);

        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $category = ProductCategory::find($product->category_id);
        return view('products.show')->with('product', $product)->with('category', $category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $product_categories = ProductCategory::all();
        return view('products.edit')->with('product', $product)->with('product_categories', $product_categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->title = $request->title;
        $product->price = $request->price;

        $product->description = $request->get('description');
        $product->category_id = $request->get('category_id');

        $product->save();
        $request->session()->flash('message', 'Produkt bol úspešne zmenená.');

        return redirect('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $product)
    {
        $product->delete();
        $request->session()->flash('message', 'Produkt bol úspešne vymazany.');
        return redirect('products');
    }

    public function getAddToCart(Request $request, $id) {
        $product = Product::find($id);

        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;

        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);

        $request->session()->put('cart', $cart);

        return redirect()->route('products.index');
    }

    public function getPlusOneToCart(Request $request, $id) {
        $product = Product::find($id);

        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;

        $cart = new Cart($oldCart);
        $cart->plusOne($product, $product->id);

        $request->session()->put('cart', $cart);

        return redirect()->route('product.shoppingCart');
    }

    public function getMinusOneToCart(Request $request, $id) {
        $product = Product::find($id);

        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;

        $cart = new Cart($oldCart);
        $cart->minusOne($product, $product->id);

        $request->session()->put('cart', $cart);

        return redirect()->route('product.shoppingCart');
    }

    public function getRemoveFromCart(Request $request, $id) {
        $product = Product::find($id);

        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;

        $cart = new Cart($oldCart);
        $cart->remove($product, $product->id);

        $request->session()->put('cart', $cart);

        return redirect()->route('product.shoppingCart');
    }

    public function getCart() {
        if (!Session::has('cart')) {
            return view('products.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('products.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice, 'totalQty' => $cart->totalQty]);
    }

    public function getCheckout() {
        if (!Session::has('cart')) {
            return view('products.shopping-cart');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('products.checkout', ['totalPrice' => $total]);
    }

    public function getProfile() {
        $user = Auth::user();
        return view('products.profile')->with('user', $user);
    }
}
