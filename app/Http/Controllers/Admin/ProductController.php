<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;

class ProductController extends Controller
{
    public function getProducts()
    {
        $products = Product::with('category','subcategory')->get();
        return $products;
    }
    public function getProduct($slug)
    {
        $product = Product::with('reviews.user')->where('slug' , $slug)->first();
        $category = Category::where('id' , $product->category_id)->select('title','slug')->get();
        $relatedproducts = Product::where('id', '!=', $product->id)->get()->random(4);

        return response()->json([
            'product' => $product,
            'category' => $category,
            'relatedproducts' => $relatedproducts
        ]);
    }
    public function getFeaturedProducts()
    {
        $products = Product::where('featured' , 1)->with('category','subcategory')->get()->random(4);

        return $products;
    }
    public function getLatestProducts()
    {
        $products = Product::with('category','subcategory')->latest()->take(4)->get();

        return $products;
    }

    public function getProductsByCategory($category)
    {
        $category = Category::where('slug' , $category)->first();

        $products = Product::where('category_id' , $category->id)->get();

        // $categories = Category::orderBy('title' , 'asc')->get();

     
        return $products;
    }
    public function getProductsBySubCategory($subcategory)
    {
        $subcategory = SubCategory::where('slug' , $subcategory)->first();

        $products = Product::where('subcategory_id' , $subcategory->id)->get();

        $category = Category::where('id' , $subcategory->category_id)->select('title')->get();

     
        return response()->json([
            'products' => $products,
            'category' => $category,
        ]);
    }

    public function search($query)
    {
        $search = $query;
        $products = Product::where('title' , 'LIKE' , "%{$query}%")->get();

        return response()->json([
            'products' => $products,
            'search_title' => $search,
        ]);

    }
}