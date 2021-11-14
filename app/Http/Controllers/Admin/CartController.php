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
        $product = Product::find($request->id);

        if($product->discount_price == null){
            $total = $product->price*$product->quantity;
        } else {
            $total = $product->discount_price*$product->quantity;
        }

        $cart = Cart::create([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'total' =>$total
        ]);

        return $cart::with('product');
    }

}
 