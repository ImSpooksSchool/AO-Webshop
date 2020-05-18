<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property User $user
 * @property array $products
 * @property bool $handled
 * @package App
 */
class Order extends Model {
    protected $guarded = [];

    protected $casts = [
        'products' => 'array'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getId(): int {
        return $this->id;
    }

    public function getUser(): User {
        return $this->user;
    }

    public function setUser(User $user): void {
        $this->user = $user;
    }

    public function getProductsInternal(): array {
        return $this->products;
    }

    public function setProductsInternal(array $products): void {
        $this->products = $products;
    }

    public function getProducts(): array {
        $products = [];
        foreach (Product::all() as $product) {
            if (array_key_exists($product->getId(), $this->getProductsInternal())) {
                array_push($products, $product);
            }
        }
        return $products;
    }

    public function getProductsWithAmount(): array {
        $products = [];
        foreach (Product::all() as $product) {
            if (array_key_exists($product->getId(), $this->getProductsInternal())) {
                $products[$product] = $this->getProductsInternal()[$product->getId()];
            }
        }
        return $products;
    }

    public function isHandled(): bool {
        return $this->handled;
    }

    public function setHandled(bool $handled): void {
        $this->handled = $handled;
        $this->save();
    }

    public static function createFromCart(ShoppingCart $cart, User $user): Order {
        $order = new Order();
        $order->setUser($user);
        $order->setProductsInternal($cart->getProducts());
        return $order;
    }
}
