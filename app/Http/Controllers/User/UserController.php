<?php
/**
 * Created by Nick on 18 May 2020.
 * Copyright © ImSpooks
 */


namespace App\Http\Controllers\User;


use App\Category;
use App\Product;
use App\ShoppingCart;
use App\Utils\SpooksUtils;
use Illuminate\Http\Request;

class UserController {

    public function showCategory(Category $category) {
        return view("user.category", ["category" => $category]);
    }

    public function showProduct(Product $product) {
        return view("user.product", ["product" => $product]);
    }

    public function addToCart(Request $request, Product $product) {
        $cart = ShoppingCart::getInstance($request);
        $cart->addProduct($product, SpooksUtils::getOrDefault($request->get("amount"), 1));

        return redirect("/cart");
    }
}
