<?php
/**
 * Created by Nick on 18 May 2020.
 * Copyright © ImSpooks
 */


namespace App\Http\Controllers;


use App\Category;
use App\Product;
use App\ShoppingCart;
use App\Utils\SpooksUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {

    public function __construct() {
//        $this->middleware("auth");
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

    public function order() {
        if (!Auth::check()) {
            return redirect("/login?redirect=/order");
        }
        return view("user.order", ["cart" => ShoppingCart::getInstance()]);
    }

    public function orderSuccess() {
        return view("user.ordersuccess");
    }

    public function orderList() {
        if (!Auth::check()) {
            return redirect("/login?redirect=/orderlist");
        }
        return view("user.orderlist");
    }

    public function storeOrder(Request $request) {
        $required = ["firstname", "lastname", "country", "state", "street", "streetnr", "zip", "city"];

        foreach ($required as $require) {
            if (!$request->has($require)) {
                return redirect("/order");
            }
        }


        $get = function(Request $request, string $key, $defaultValue = "") {
            return SpooksUtils::getOrDefault($request->get($key), $defaultValue);
        };

        $cart = ShoppingCart::getInstance();

        $order = $cart->toOrder();
        $order->setFullname($get($request, "firstname") . " " . $get($request, "lastname"));
        $order->setCountry($get($request, "country"));
        $order->setState($get($request, "state"));
        $order->setStreet($get($request, "street") . " " . $get($request, "streetnr"));
        $order->setZip($get($request, "zip"));
        $order->setCity($get($request, "city"));
        $order->setPhone($get($request, "phone"));
        $order->save();

        $cart->clear();

        return redirect("/ordersuccess");
    }

    public function addToCart(Product $product) {
        $cart = ShoppingCart::getInstance();
        $cart->addProduct($product);

        return redirect("/cart");
    }

    public function setCart(Request $request) {
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
