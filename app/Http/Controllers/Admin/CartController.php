<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{

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

}
 