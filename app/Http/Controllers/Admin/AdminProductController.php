<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Utils\Placeholder;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

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
        $product = new Product();
        $product->setCategory($category);
        $product->setName($request->get("name"));
        $product->setLabel($request->get("label"));
        $product->setDescription($request->get("description"));
        $product->setPrice(floatval($request->get("price")));

        $product->save();

        $path = "uploads/products/" . $product->getId() . "/";
        $product->setPhoto($path);
        $product->save();

        $image = Image::make($request->get("photo"))->encode("png", 100);

        if (!file_exists($path))
            mkdir(public_path($path), 0777, true);

        $image->save(public_path(Placeholder::replace($path . "{name}.png", ["name" => "x512"])));
        $image->resize(64, 64)->save(public_path(Placeholder::replace($path . "{name}.png", ["name" => "x64"])));

        return redirect("/admin");
    }

    public function show(Product $product) {

    }

    public function edit(Product $product) {
        return view("admin.product.edit", ["product" => $product]);
    }

    public function update(Request $request, Product $product) {
        $product->setName($request->get("name"));
        $product->setLabel($request->get("label"));
        $product->setDescription($request->get("description"));
        $product->setPrice(floatval($request->get("price")));
        $product->save();

        if ($request->get("photo") != null) {
            $path = $product->getPhoto();

            $image = Image::make($request->get("photo"))->encode("png", 100);

            if (!file_exists($path))
                mkdir(public_path($path), 0777, true);

            $image->save(public_path(Placeholder::replace($path . "{name}.png", ["name" => "x512"])));
            $image->resize(64, 64)->save(public_path(Placeholder::replace($path . "{name}.png", ["name" => "x64"])));
        }

        return redirect("/admin");
    }

    public function destroy(Product $product) {
        $product->delete();
        return redirect("/admin");
    }
}
