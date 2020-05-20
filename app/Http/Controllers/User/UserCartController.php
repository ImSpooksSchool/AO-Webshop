<?php
/**
 * Created by Nick on 18 May 2020.
 * Copyright © ImSpooks
 */


namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Product;
use App\ShoppingCart;
use Illuminate\Http\Request;

class UserCartController extends Controller {

    public function set(Request $request) {
        if (!$request->has("id") || !$request->has("newVal"))
            return ["response" => false,
                "has_id" => $request->has("id"), "newVal" => $request->has("newVal")];

        $product_id = intval($request->get("id"));
        $new = intval($request->get("newVal"));

        $product = Product::find($product_id);
        $cart = ShoppingCart::getInstance();

        if ($new <= 0) {
            $cart->deleteProduct($product);
        } else if ($cart->getProducts()[$product->getId()] < $new){
            $cart->addProduct($product);
        } else {
            $cart->removeProduct($product);
        }

        return ["response" => true];
    }
}
