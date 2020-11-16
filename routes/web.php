<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// Users

Route::get("/", "HomeController@index")->name("home");
Route::get("/home", "HomeController@index");
Route::get("/category", "HomeController@index");

Route::get("/category/{category}", "UserController@showCategory")->name("show-category");
Route::get("/product/{product}", "UserController@showProduct")->name("show-product");
Route::get("/cart", "UserController@showCart")->name("show-cart");

Route::get("/addToCart/{product}", "UserController@addToCart")->name("add-to-cart");
Route::post("/cart/set", ["before" => "csrf", "uses" => "UserController@setCart"])->name("cart-set");

Route::get("/order", "UserController@order")->name("cart-order");
Route::post("/order", ["before" => "csrf", "uses" => "UserController@storeOrder"])->name("cart-order-final");
Route::get("/ordersuccess", "UserController@orderSuccess");
Route::get("/orderlist", "UserController@orderList")->name("cart-orderlist");

// Admin panel
Route::get("/admin", "AdminController@index")->name("admin-panel");
Route::get("/handleorder/{order}", "AdminController@handleOrder")->name("handle-order");
Route::get("/admin/debug", "AdminController@debug");

// Categories
// Add
Route::get("/admin/category/add", "AdminController@createCategory")->name("category-add");
Route::post("/admin/category/add", ["before" => "csrf", "uses" => "AdminController@storeCategory"])->name("category-store");
// Edit
Route::get("/admin/category/edit/{category}", "AdminController@editCategory")->name("category-edit");
Route::post("/admin/category/edit/{category}", ["before" => "csrf", "uses" => "AdminController@updateCategory"])->name("category-update");
// Delete
Route::get("/admin/category/delete/{category}", ["before" => "csrf", "uses" => "AdminController@destroyCategory"])->name("category-destroy");


// Products
// Add
Route::get("/admin/products/add/{category}", "AdminController@createProduct")->name("product-add");
Route::post("/admin/products/add/{category}", ["before" => "csrf", "uses" => "AdminController@storeProduct"])->name("product-store");
// Edit
Route::get("/admin/products/edit/{product}", "AdminController@editProduct")->name("product-edit");
Route::post("/admin/products/edit/{product}", ["before" => "csrf", "uses" => "AdminController@updateProduct"])->name("product-update");
// Delete
Route::get("/admin/products/delete/{product}", ["before" => "csrf", "uses" => "AdminController@destroyProduct"])->name("product-destroy");
