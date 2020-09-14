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
}
