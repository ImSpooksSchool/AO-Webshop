<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ShoppingCart extends Model {

    protected $guarded = [];

    public static function getInstance(Request $request): ShoppingCart {
        $cart = $request->session()->get("cart");
        if (!isset($cart))
            $request->session()->put("cart", $cart = new ShoppingCart());
        return $cart;
    }

    private array $products = [];

    public function addProduct(Product $product, int $amount = 1): void {
        if ($product == null)
            return;

        $amount = 0;
        if (array_key_exists($product->getId(), $this->products)) {
            $amount = $this->products[$product->getId()];
        }
        $this->products[$product->getId()] = ($amount + $amount);
    }

    public function removeProduct(Product $product): void {
        if ($product == null)
            return;
        unset($this->products[$product->getId()]);
    }

    public function getProducts(): array {
        return $this->products;
    }
}
