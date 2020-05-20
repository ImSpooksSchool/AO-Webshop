<?php
/**
 * Created by Nick on 18 May 2020.
 * Copyright © ImSpooks
 */


namespace App\Http\Controllers\User;


use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\ShoppingCart;

class UserController extends Controller {

    public function __construct() {
        $this->middleware("auth");
    }

    public function showCategory(Category $category) {
        return view("user.category", ["category" => $category]);
    }

    public function showProduct(Product $product) {
        return view("user.product", ["product" => $product]);
    }

    public function showCart() {
        return view("user.cart");
    }

    public function addToCart(Product $product) {
        $cart = ShoppingCart::getInstance();
        $cart->addProduct($product);

        return redirect("/cart");
    }
}
