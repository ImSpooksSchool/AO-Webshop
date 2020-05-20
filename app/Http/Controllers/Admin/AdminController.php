<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Order;

class AdminController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('isadmin');
    }

    public function index() {
        return view("admin.index");
    }

    public function handleOrder(Order $order) {
        $order->setHandled(!$order->isHandled());
        $order->save();
        return redirect("/admin");
    }

    public function debug() {
        return Category::find(1)->getProducts();
    }
}
