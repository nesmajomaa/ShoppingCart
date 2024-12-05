<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::select('*')->withTrashed()->paginate(10);
        return view('admin.cart.index')->with('cart', $cart);
    }

    public function removeItemFromCart($itemId){
        Cart::where('id', $itemId)->forceDelete();
    	return redirect()->back();
    }

    public function addToCart($itemId){
        $cart= Cart::where('product_id', $itemId)->first();
        $product = Product::find($itemId);
        if(!$cart){
            $cart = new Cart;
            $cart->product_id = $itemId;
            $cart->user_id = 1;
            $cart->quantity = 1;
            $cart->total_price = 1 * $product->price;
            $status = $cart->save();
            return redirect()->back()->with('status', $status);
        }else{
            $cart->quantity = $cart->quantity + 1;
            $cart->total_price = $cart->total_price + $product->price;
            $status = $cart->save();
            return redirect()->back()->with('status', $status);
        }
    }

    public function increaseItem($itemId){
        $cart= Cart::where('product_id', $itemId)->first();
        $product = Product::find($itemId);
        $newQuantity = $cart->quantity + 1;
        if($newQuantity > $product->quantity){
            return redirect()->back();
        }else{
            $cart->quantity = $cart->quantity + 1;
            $cart->total_price = $cart->total_price + $product->price;
            $status = $cart->save();
            return redirect()->back()->with('status', $status);
        }
    }
    public function decreaseItem($itemId){
        $cart= Cart::where('product_id', $itemId)->first();
        $product = Product::find($itemId)->quantity;
        $newQuantity = $cart->quantity - 1;
        if($newQuantity <= 0){
            return redirect()->back();
        }else{
            $cart->quantity = $cart->quantity - 1;
            $cart->total_price = $cart->total_price - $product->price;
            $status = $cart->save();
            return redirect()->back()->with('status', $status);
        }
    }
}
