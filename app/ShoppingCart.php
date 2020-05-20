<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/**
 * @property array $products
 * @package App
 */
class ShoppingCart {

    public static function getInstance(): ShoppingCart {
        $cart = Session::get("cart");
        if (!isset($cart))
            Session::put("cart", ($cart = new ShoppingCart())->serialize());
        else
            $cart = self::deserialize($cart);
        return $cart;
    }

    private array $products = [];

    public function addProduct(Product $product, int $add = 1): void {
        if ($product == null)
            return;

        $amount = 0;
        if (array_key_exists($product->getId(), $this->products)) {
            $amount = $this->products[$product->getId()];
        }
        $this->products[$product->getId()] = ($amount + $add);

        $this->saveSession();
    }

    public function removeProduct(Product $product, int $remove = 1): void {
        if ($product == null)
            return;

        $amount = 0;
        if (array_key_exists($product->getId(), $this->products)) {
            $amount = $this->products[$product->getId()];
        }
        if ($amount - $remove > 0)
            $this->products[$product->getId()] = ($amount - $remove);
        else
            unset($this->products[$product->getId()]);

        $this->saveSession();
    }

    public function deleteProduct(Product $product): void {
        if ($product == null)
            return;
        unset($this->products[$product->getId()]);

        $this->saveSession();
    }

    public function clear() {
        $this->products = [];
        Session::remove("cart");
    }

    public function getProducts(): array {
        return $this->products;
    }

    public function saveSession(): void {
        Session::put("cart", $this->serialize());
    }

    public function toOrder(): Order {
        return Order::createFromCart($this, Auth::user());
    }

    private function serialize(): array {
        return $this->products;
    }

    private static function deserialize(array $input): ShoppingCart {
        $cart = new ShoppingCart();
        $cart->products = $input;
        return $cart;
    }
}
