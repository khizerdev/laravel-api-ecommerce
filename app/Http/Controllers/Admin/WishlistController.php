<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;

class WishlistController extends Controller
{

    public function store(Request $request)
    {
     

        $exist = Wishlist::where('user_id' , $request->user_id)->where('product_id' , $request->product_id)->first();
      

        if(!$exist) {
            
            $addToWishList = Wishlist::create([
                'user_id' => $request->user_id,
                'product_id' => $request->product_id,
            ]);

            
            if($addToWishList){
                return response()->json(['success' => 'Product Added to Wishlist']);
            }

        } else {
            return response()->json(['error' => 'Product Already added to Wishlist']);
        }



        
    }

    public function index($id)
    {
        $wishlist = Wishlist::with('product')->where('user_id' , $id)->latest()->get();
      
        return $wishlist;
    }

    public function delete($user_id , $product_id)
    {
       
        $product_id = $product_id;
        $user_id = $user_id;

        $wishlist = Wishlist::where('product_id',$product_id)->where('user_id',$user_id )->delete();
        return $wishlist;
    
     
    }
}
 