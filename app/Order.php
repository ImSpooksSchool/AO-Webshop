<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property User $user
 * @property string $fullname
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $street
 * @property string $zip
 * @property string $phone
 * @property array $products
 * @property int $handled
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
        $this->user()->associate($user);
    }

    public function getProducts(): array {
        return $this->products;
    }

    public function setProducts(array $products): void {
        $this->products = $products;
    }

    /**
     * @return string
     */
    public function getFullname(): string {
        return $this->fullname;
    }

    /**
     * @param string $fullname
     */
    public function setFullname(string $fullname): void {
        $this->fullname = $fullname;
    }

    /**
     * @return string
     */
    public function getCountry(): string {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country): void {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getState(): string {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState(string $state): void {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getCity(): string {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getStreet(): string {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet(string $street): void {
        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getZip(): string {
        return $this->zip;
    }

    /**
     * @param string $zip
     */
    public function setZip(string $zip): void {
        $this->zip = $zip;
    }

    /**
     * @return string
     */
    public function getPhone(): string {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void {
        $this->phone = $phone;
    }

    public function isHandled(): bool {
        return $this->handled == 0 ? false : true;
    }

    public function setHandled(bool $handled): void {
        $this->handled = $handled ? 1 : 0;
        $this->save();
    }

    public static function createFromCart(ShoppingCart $cart, User $user): Order {
        $order = new Order();
        $order->setUser($user);
        $order->setProducts($cart->getProducts());
        return $order;
    }
}
