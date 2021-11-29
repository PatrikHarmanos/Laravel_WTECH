<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_item;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class ProductsController extends Controller
{
    public function getWelcome() {
        $productsOne = Product::all()->take(4);
        $productsTwo = Product::latest()->take(4)->get();
        return view('products.welcome')->with('productsOne', $productsOne)->with('productsTwo', $productsTwo);
    }
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
            $products = Product::where('title', 'ILIKE', '%'.$search.'%')->paginate(8);
            return view('products.index')->with('products', $products)->with('category', 'Všetky produkty')->with('user', $user);
        } else if ($selected_category) {
            $category_id = ProductCategory::where('category_name', $selected_category)->first()->id;
            $products = Product::where('category_id', 'LIKE', $category_id)->paginate(8);
            return view('products.index')->with('products', $products)->with('category', $selected_category)->with('user', $user);
        } else if ($orderBy){
            $products = Product::orderBy($orderBy, $orderType)->paginate(8);
            return view('products.index')->with('products', $products)->with('category', 'Všetky produkty')->with('user', $user);
        } else if ($price) {
            if ($price == '<20')
                $products = Product::where('price', '<', 20)->paginate(8);
            else if ($price == '<50')
                $products = Product::whereBetween('price', array(20, 50))->paginate(8);
            else if ($price == '>50')
                $products = Product::where('price', '>', 50)->paginate(8);

            return view('products.index')->with('products', $products)->with('category', 'Všetky produkty')->with('user', $user);
        } else {
            $products = Product::paginate(8);
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
            'title' => 'required|between:1,30',
            'price' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg',
            'description' => 'required||between:1,500'
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
        $request->validate([
            'title' => 'required|between:1,30',
            'price' => 'required',
            'description' => 'required||between:1,500'
        ]);

        $product->title = $request->title;
        $product->price = $request->price;

        // ak pouzivatel nahral novu fotku
        if ($request->image != null) {
            // delete old picture
            unlink(public_path() . '/images/' . $product->image_path);
            // save new picture
            $newImageName = time() . '-' . $request->title . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $newImageName);
            $product->image_path = $newImageName;
        }

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
        unlink(public_path() . '/images/' . $product->image_path);
        $product->delete();
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
        if ($user->email == 'admin@gmail.com'){
            $orders = Order::paginate(2);
        } else {
            $orders = Order::where('user_id', '=', $user->id)->paginate(2);
        }
        return view('products.profile')->with('user', $user)->with('orders', $orders);
    }

    public function finishOrder(Request $request) {
        $request->validate([
            'email' => 'required|email:rfc,dns',
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'psc' => 'required',
            'number' => 'required|digits:10',
            'address' => 'required'
        ]);

        if ($request->input('payment') == 'card') {
            $request->validate([
                'card_number' => 'required|digits_between:5,12',
                'card_month' => 'required|digits:2',
                'card_year' => 'required|digits:2',
                'card_csv' => 'required|digits:3'
            ]);
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        $order = Order::create([
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'psc' => $request->input('psc'),
            'phone_number' => $request->input('number'),
            'delivery' => $request->input('delivery'),
            'payment' => $request->input('payment'),
            'card_number' => $request->input('card_number'),
            'card_expiration' => $request->input('card_month') . '/' . $request->input('card_year'),
            'card_csv' => $request->input('card_csv'),
            'finished' => true,
            'totalPrice' => $cart->totalPrice,
            'totalQty' => $cart->totalQty
        ]);

        foreach ($cart->items as $product) {
            $order_item = Order_item::create([
                'order_id' => $order->id,
                'product_id' => $product['item']['id'],
                'quantity' => $product['qty']
            ]);
        }

        $request->session()->forget('cart');

        $products = Product::paginate(8);
        return view('products.index')->with('products', $products)->with('category', 'Všetky produkty');
    }
}
