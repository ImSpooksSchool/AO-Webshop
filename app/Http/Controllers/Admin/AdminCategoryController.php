<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    public function create() {
        return view("admin.category.add");
    }

    public function store(Request $request) {
        $category = new Category();
        $category->setName($request->get("name"));
        $category->setLabel($request->get("label"));
        $category->save();

        return redirect("/admin");
    }

    public function show(Category $category) {
        //
    }

    public function edit(Category $category) {
        return view("admin.category.edit", ["category" => $category]);
    }

    public function update(Request $request, Category $category) {
        $category->setName($request->get("name"));
        $category->setLabel($request->get("label"));
        $category->save();

        return redirect("/admin");
    }

    public function destroy(Category $category) {
        foreach ($category->getProducts() as $product) {
            $product->delete();
        }
        $category->delete();

        return redirect("/admin");
    }
}
