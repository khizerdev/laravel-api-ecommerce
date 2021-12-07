<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{

    public function index($user_id)
    {
        $carts = Cart::with('product')->where('user_id' , $user_id)->get();

        return $carts;
    }

    public function add(Request $request)
    {
        $product = Product::find($request->product_id);

        if($product->discount_price == null){
            $total = $product->price*$product->quantity;
        } else {
            $total = $product->discount_price*$request->quantity;
        }

        $cart = Cart::create([
            'user_id' => $request->user_id,
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'total' =>$total
        ]);

        return $cart;
    }

    public function remove($user_id , $product_id)
    {
        $remove = Cart::where('user_id' , $user_id)->where('product_id' , $product_id)->delete();
        return $remove;
    }

    public function cart_plus($user_id,$product_id,$quantity,$price)
    {
        $id = $product_id;
        $quantity = $quantity;
        $price = $price;
        $newQuantity = $quantity+1;
        $total = $price*$quantity;

        $plus = Cart::where('user_id' , $user_id)->where('product_id' , $product_id)->first();

        $plus = $plus->update([
            'quantity' => $newQuantity,
            'total' => $total,
        ]);

        return $plus;
    }
    public function cart_minus($user_id,$product_id,$quantity,$price)
    {
        $id = $product_id;
        $quantity = $quantity;
        $price = $price;
        $newQuantity = $quantity-1;
        $total = $price*$quantity;

        $plus = Cart::where('user_id' , $user_id)->where('product_id' , $product_id)->first();

        $plus = $plus->update([
            'quantity' => $newQuantity,
            'total' => $total,
        ]);

        return $plus;
    }

}
 