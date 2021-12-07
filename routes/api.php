<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

 // Login Routes 
 Route::post('/login','User\AuthController@login');
 // Register Routes 
Route::post('/register','User\AuthController@register');
 // Forget Password Routes 
Route::post('/forget-password','User\ForgetController@reset');
 // Reset Password Routes 
 Route::post('/reset-password','User\ResetController@reset');
// get auth user
 Route::get('/user','User\UserController@index')->middleware('auth:api');

// Get Visitor 
Route::get('/visitors','Admin\VisitorController@index');
// Contact Page Route
Route::post('/submit/contact-us','Admin\ContactController@store');
// get setting
Route::get('/get-setting','Admin\SettingController@getSetting');

Route::get('/get-categories', 'Admin\CategoryController@getCategories');

Route::get('/get-products', 'Admin\ProductController@getProducts');

Route::get('/product/{slug}', 'Admin\ProductController@getProduct');

Route::get('/search/product/{query}', 'Admin\ProductController@search');

Route::get('/product-category/{category}', 'Admin\ProductController@getProductsByCategory');

Route::get('/product-subcategory/{subcategory}', 'Admin\ProductController@getProductsBySubCategory');

Route::get('/get-featured-products', 'Admin\ProductController@getFeaturedProducts');

Route::get('/get-latest-products', 'Admin\ProductController@getLatestProducts');

Route::get('/get-sliders', 'Admin\SliderController@getSliders');

Route::post('/add-to-wishlist', 'Admin\WishlistController@store');

Route::get('/remove-from-wishlist/{user_id}/{product_id}', 'Admin\WishlistController@delete');

Route::get('/wishlist/{id}', 'Admin\WishlistController@index');

Route::post('/add-to-cart', 'Admin\CartController@add');

Route::get('/remove-from-cart/{user_id}/{product_id}', 'Admin\CartController@remove');

Route::get('/cart/{user_id}', 'Admin\CartController@index');

Route::get('/cart-plus/{user_id}/{product_id}/{quantity}/{price}', 'Admin\CartController@cart_plus');

Route::get('/cart-minus/{user_id}/{product_id}/{quantity}/{price}', 'Admin\CartController@cart_minus');



