<?php

namespace App\Http\Controllers;


use App\Models\Cart;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function getAddToCartAuth($id) {
        $product = Product::find($id);

        $user = Auth::user();

        if (Order::where('user_id', '=', $user->id)->exists()) {
            $order = Order::where('user_id', '=', $user->id)->first();
        } else {
            $order = Order::create([
                'user_id' => $user->id
            ]);
        }


        $order_item = Order_item::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 1
        ]);

        $order->totalPrice += $product->price;
        $order->totalQty += 1;
        $order->save();

        return redirect()->route('products.index');
    }

    public function getPlusOneToCartAuth($id) {
        $product = Product::find($id);

        $user = Auth::user();
        $order = Order::where('user_id', '=', $user->id)->first();
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
        $order = Order::where('user_id', '=', $user->id)->first();
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
        $order = Order::where('user_id', '=', $user->id)->first();
        $order_item = Order_item::where('order_id', '=', $order->id)->where('product_id', '=', $product->id)->first();

        $order->totalQty -= 1;
        $order->totalPrice -= $product->price * $order_item->quantity;
        $order->save();

        $order_item->delete();

        return redirect()->route('auth.product.shoppingCart');
    }

    public function getCartAuth() {
        $user = Auth::user();

        $order = Order::where('user_id', '=', $user->id)->first();

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
}
