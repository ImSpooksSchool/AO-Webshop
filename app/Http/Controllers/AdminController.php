<?php

namespace App\Http\Controllers;

use App\Category;
use App\Order;
use App\Product;
use App\Utils\Placeholder;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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

    /*
     * MAIN STUFF
     */

    public function index() {
        return view("admin.index");
    }

    public function handleOrder(Order $order) {
        $order->setHandled(!$order->isHandled());
        $order->save();
        return redirect("/admin");
    }

    /*
     * CATEGORY STUFF
     */

    public function createCategory() {
        return view("admin.category.add");
    }

    public function storeCategory(Request $request) {
        $category = new Category();
        $category->setName($request->get("name"));
        $category->setLabel($request->get("label"));
        $category->save();

        return redirect("/admin");
    }

    public function showCategory(Category $category) {
        //
    }

    public function editCategory(Category $category) {
        return view("admin.category.edit", ["category" => $category]);
    }

    public function updateCategory(Request $request, Category $category) {
        $category->setName($request->get("name"));
        $category->setLabel($request->get("label"));
        $category->save();

        return redirect("/admin");
    }

    public function destroyCategory(Category $category) {
        foreach ($category->getProducts() as $product) {
            $product->delete();
        }
        $category->delete();

        return redirect("/admin");
    }

    /*
     * PRODUCT STUFF
     */

    public function createProduct(Category $category) {
        return view("admin.product.add", ["category" => $category]);
    }

    public function storeProduct(Request $request, Category $category) {
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

        $this->storePhoto($path, $request->get("photo"));

        return redirect("/admin");
    }

    public function showProduct(Product $product) {

    }

    public function editProduct(Product $product) {
        return view("admin.product.edit", ["product" => $product]);
    }

    public function updateProduct(Request $request, Product $product) {
        $product->setName($request->get("name"));
        $product->setLabel($request->get("label"));
        $product->setDescription($request->get("description"));
        $product->setPrice(floatval($request->get("price")));
        $product->save();

        if ($request->get("photo") != null) {
            $path = $product->getPhoto();

            $this->storePhoto($path, $request->get("photo"));
        }

        return redirect("/admin");
    }

    public function destroyProduct(Product $product) {
        try {
            $product->delete();
        } catch (\Exception $e) {
        }
        return redirect("/admin");
    }

    private function storePhoto(string $path, string $photo): void {
        $image = Image::make($photo)->encode("png", 100);

        if (!file_exists($path))
            mkdir(public_path($path), 0777, true);

        $image->save(public_path(Placeholder::replace($path . "{name}.png", ["name" => "x512"])));
        $image->resize(64, 64)->save(public_path(Placeholder::replace($path . "{name}.png", ["name" => "x64"])));
    }
}
