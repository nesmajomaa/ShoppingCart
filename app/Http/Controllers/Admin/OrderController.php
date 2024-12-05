<?php

namespace App\Http\Controllers\Admin;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->select('*')->withTrashed()->paginate(10);
        return view('admin.orders')->with('orders', $orders);
    }

    public function orderItems($orderId)
    {
        $orderItems = OrderItem::where('order_id' , $orderId)->with('product')->get();
        return view('admin.orderItems')->with('orderItems', $orderItems);
    }

    public function checkout($totalPrice){
        $cartItems = Cart::where('user_id', 1)->where('deleted_at', null)->get();

        $order = new Order;
        $order->user_id = 1;
        $order->status = 'pending';
        $order->last_price = $totalPrice;
        $order->save();
        
        foreach($cartItems as $cartItem){
            $orderItem = new OrderItem;
            $orderItem->order_id = $order->id;
            $orderItem->product_id =  $cartItem->product_id;
            $orderItem->quantity = $cartItem->quantity;
            $orderItem->total_price = $cartItem->total_price;
            $orderItem->save();
            $product = Product::find($cartItem->product_id);
            $product->quantity = $product->quantity - $cartItem->quantity;
            $product->sales = $product->sales + $cartItem->quantity;
            $product->update();
            Cart::where('id', $cartItem->id)->delete();
        }

        //return redirect()->route('index.success')->with('success', 'Checkout successful!');
        return redirect()->back()->with('status', 'Checkout successful!');
    }

    public function update(Request $request)
    {
        $order = Order::find($request->id);
        $order->cart_id = $request->cart_id;
        $order->status = $request->status;
    	$status = $order->save();
		return redirect()->back()->with('status', $status);
    }

    public function destroy($id)
    {
        Order::where('id', $id)->delete();
    	return redirect()->back();
    }

    public function restore($id)
    {
        Order::onlyTrashed()->where('id', $id)->restore();
    	return redirect()->back();
    }
}
