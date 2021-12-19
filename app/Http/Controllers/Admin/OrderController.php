<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class OrderController extends Controller
{
    public function store(Request $request){

        
        $user = User::find($request->user_id);

        $cart = Cart::where('user_id' , $user->id)->get();

        $orders =0;

        foreach($cart as $item) {

            $product = Product::find($item->product_id);

            $total = 0;

            if($product->discount_price == null){
                $total = $product->price*$item->quantity;
            } else {
                $total = $product->discount_price*$item->quantity;
            }

            $order = Order::create([
                'user_id' => $user->id,
                'invoice_no' => "Vic".'-'.rand(),
                'product_id' => $product->id,
                'qty' => $item->quantity,
                'total' => $total,
                'payment_method' => $request->payment_method,
                'address' => $request->address,
                'city' => $request->city,
                'delivery_charges' => $request->delivery_charges,
                'status' => "pending",
            ]);

            if($order){
                $cart = Cart::find($item->id)->delete();
                $orders = 1;
            }
        }

        return $orders;
    
    } 

}
 