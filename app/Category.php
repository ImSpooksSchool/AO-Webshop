<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $label
 * @package App
 */
class Category extends Model {
    protected $guarded = [];

    /**
     * @return int Category unique id
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @return string Category name
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string|null $name New name
     */
    public function setName($name): void {
        $this->name = $name;
    }

    /**
     * @return string Category label
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
     * Returns a list of all products where
     * the category matches to this class.
     * @code {Product#getCategory()->getId() === $this->getId()}
     *
     * @return array Child products
     */
    public function getProducts(): array {
        $result = [];

        foreach(Product::all() as $product) {
            if ($product->getCategory()->getId() === $this->getId()) {
                array_push($result, $product);
            }
        }
        return $result;
    }
}
