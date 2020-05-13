<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Category $category
 * @property string $name
 * @property string $label
 * @property string $description
 * @property string $photo
 * @property float $price
 * @package App
 */
class Product extends Model {
    protected $guarded = [];

    /**
     * @return int|null Product unique id
     */
    public function getId() {
        return $this->id;
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    /**
     * @param $category Category New category
     */
    public function setCategory(Category $category) {
        $this->category()->associate($category);
    }

    /**
     * @return Category Product category
     */
    public function getCategory(): Category {
        return $this->category;
    }

    /**
     * @return string Product name
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name New name
     */
    public function setName(string $name): void {
        $this->name = $name;
    }

    /**
     * @return string Product label
     */
    public function getLabel(): string {
        return $this->label != null ? $this->label : $this->getName();
    }

    /**
     * @param string|null $label New label
     */
    public function setLabel($label): void {
        $this->label = $label;
    }

    /**
     * @return string Product description
     */
    public function getDescription(): string {
        return $this->description != null ? $this->description : "";
    }

    /**
     * @param string|null $description New description
     */
    public function setDescription($description): void {
        $this->description = $description;
    }

    /**
     * @return string Product photo URL
     */
    public function getPhoto(): string {
        return $this->photo != null ? $this->photo : "";
    }

    /**
     * @param string $url New target URL
     */
    public function setPhoto(string $url): void {
        $this->photo = $url;
    }

    /**
     * @return float Product price
     */
    public function getPrice(): float {
        return $this->price != null ? $this->price : 1;
    }

    /**
     * @param float $price New price
     */
    public function setPrice(float $price): void {
        $this->price = $price;
    }
}
