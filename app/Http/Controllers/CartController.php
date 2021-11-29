<?php

namespace App\Http\Controllers;


use App\Models\Cart;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function getAddToCartAuth($id) {
        $product = Product::find($id);

        $user = Auth::user();
        $order = Order::where([
            ['user_id', '=', $user->id],
            ['finished', '=', null]
        ])->first();


        if ($order) {
            $order = Order::where('user_id', '=', $user->id)->first();
            $order->totalPrice += $product->price;
            $order->totalQty += 1;
            $order->save();
        } else {
            $order = Order::create([
                'user_id' => $user->id,
                'totalPrice' => $product->price,
                'totalQty' => 1
            ]);
        }

        $order_item = Order_item::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 1
        ]);

        return redirect()->route('products.index');
    }

    public function getPlusOneToCartAuth($id) {
        $product = Product::find($id);

        $user = Auth::user();
        $order = Order::where([
            ['user_id', '=', $user->id],
            ['finished', '=', null]
        ])->first();
        $order_item = Order_item::where('order_id', '=', $order->id)->where('product_id', '=', $product->id)->first();
        $order_item->quantity += 1;
        $order_item->save();

        $order->totalPrice += $product->price;
        $order->save();

        return redirect()->route('auth.product.shoppingCart');
    }

    public function getMinusOneToCartAuth($id) {
        $product = Product::find($id);

        $user = Auth::user();
        $order = Order::where([
            ['user_id', '=', $user->id],
            ['finished', '=', null]
        ])->first();
        $order_item = Order_item::where('order_id', '=', $order->id)->where('product_id', '=', $product->id)->first();
        $order_item->quantity -= 1;
        $order_item->save();

        $order->totalPrice -= $product->price;
        $order->save();

        return redirect()->route('auth.product.shoppingCart');
    }

    public function getRemoveFromCartAuth($id){
        $product = Product::find($id);

        $user = Auth::user();
        $order = Order::where([
            ['user_id', '=', $user->id],
            ['finished', '=', null]
        ])->first();
        $order_item = Order_item::where('order_id', '=', $order->id)->where('product_id', '=', $product->id)->first();

        $order->totalQty -= 1;
        $order->totalPrice -= $product->price * $order_item->quantity;
        $order->save();

        $order_item->delete();

        return redirect()->route('auth.product.shoppingCart');
    }

    public function getCartAuth() {
        $user = Auth::user();

        $order = Order::where([
            ['user_id', '=', $user->id],
            ['finished', '=', null]
        ])->first();

        $products = array();
        $q = array();

        if ($order) {
            $ids = Order_item::where('order_id', '=', $order->id)->get();

            foreach ($ids as $id){
                $q[$id->product_id] = $id->quantity;
                $d = Product::where('id', $id->product_id)->get();
                foreach ($d as $i){
                    array_push($products, $i);
                }
            }
            return view('products.shopping-cart', ['products' => $products, 'totalPrice' => $order->totalPrice, 'totalQty' => $order->totalQty, 'quantity' => $q]);
        } else {
            return view('products.shopping-cart', ['products' => $products, 'totalPrice' => 0, 'totalQty' => 0, 'quantity' => $q]);
        }
    }

    public function getCheckoutAuth() {
        $user = Auth::user();

        $order = Order::where([
            ['user_id', '=', $user->id],
            ['finished', '=', null]
        ])->first();

        return view('products.checkout', ['totalPrice' => $order->totalPrice]);
    }

    public function finishOrderAuth(Request $request) {

        $user = Auth::user();

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

        $order = Order::where([
            ['user_id', '=', $user->id],
            ['finished', '=', null]
        ])->first();

        $order->email = $request->input('email');
        $order->name = $request->input('name');
        $order->address = $request->input('address');
        $order->city = $request->input('city');
        $order->psc = $request->input('psc');
        $order->phone_number = $request->input('number');
        $order->delivery = $request->input('delivery');
        $order->payment = $request->input('payment');
        $order->card_number = $request->input('card_number');
        $order->card_expiration = $request->input('card_month') . '/' . $request->input('card_year');
        $order->card_csv = $request->input('card_csv');
        $order->finished = true;

        $order->save();

        $products = Product::paginate(8);
        return view('products.index')->with('products', $products)->with('category', 'Všetky produkty')->with('user', $user);
    }
}
