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
Route::get("/home", "HomeController@index")->name("home");
Route::get("/category", "HomeController@index");

Route::get("/category/{category}", "User\UserController@showCategory")->name("show-category");
Route::get("/product/{product}", "User\UserController@showProduct")->name("show-product");
Route::get("/cart", "User\UserController@showCart")->name("show-cart");

Route::get("/addToCart/{product}", "User\UserController@addToCart")->name("add-to-cart");

Route::post("/cart/set", ["before" => "csrf", "uses" => "User\UserCartController@set"])->name("cart-set");

// Admin panel
Route::get("/admin", "Admin\AdminController@index");
Route::get("/admin/debug", "Admin\AdminController@debug");

// Categories
// Add
Route::get("/admin/category/add", "Admin\AdminCategoryController@create")->name("category-add");
Route::post("/admin/category/add", ["before" => "csrf", "uses" => "Admin\AdminCategoryController@store"])->name("category-store");
// Edit
Route::get("/admin/category/edit/{category}", "Admin\AdminCategoryController@edit")->name("category-edit");
Route::post("/admin/category/edit/{category}", ["before" => "csrf", "uses" => "Admin\AdminCategoryController@update"])->name("category-update");
// Delete
Route::get("/admin/category/delete/{category}", ["before" => "csrf", "uses" => "Admin\AdminCategoryController@destroy"])->name("category-destroy");


// Products
// Add
Route::get("/admin/products/add/{category}", "Admin\AdminProductController@create")->name("product-add");
Route::post("/admin/products/add/{category}", ["before" => "csrf", "uses" => "Admin\AdminProductController@store"])->name("product-store");
// Edit
Route::get("/admin/products/edit/{product}", "Admin\AdminProductController@edit")->name("product-edit");
Route::post("/admin/products/edit/{product}", ["before" => "csrf", "uses" => "Admin\AdminProductController@update"])->name("product-update");
// Delete
Route::get("/admin/products/delete/{product}", ["before" => "csrf", "uses" => "Admin\AdminProductController@destroy"])->name("product-destroy");
