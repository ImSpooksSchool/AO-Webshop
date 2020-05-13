<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function create(Category $category) {
        return view("admin.product.add", ["category" => $category]);
    }

    public function store(Request $request, Category $category) {
        //
    }

    public function show(Product $product) {
        //
    }

    public function edit(Product $product) {
        //
    }

    public function update(Request $request, Product $product) {
        //
    }

    public function destroy(Product $product) {
        //
    }
}
