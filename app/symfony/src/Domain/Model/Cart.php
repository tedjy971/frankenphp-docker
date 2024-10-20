<?php

namespace Domain\Model;

use Domain\Exception\CartException;

class Cart {
    private array $items = [];

    public function __construct(array $products = []) {
        $this->products = $products;
    }

    /**
     * @throws CartException
     */
    public function addItem(Product $product, int $quantity): void
    {
        if ($quantity <= 0) {
            throw CartException::quantityMustBeGreaterThanZero();
        }

        if (isset($this->items[$product->getId()])) {
            $this->items[$product->getId()]['quantity'] += $quantity;
        } else {
            $this->items[$product->getId()] = [
                'product' => $product,
                'quantity' => $quantity
            ];
        }
    }


    /**
     * @throws CartException
     */
    public function removeItem(Product $product): void
    {
        if (isset($this->items[$product->getId()])) {
            unset($this->items[$product->getId()]);
        }
        else {
            throw CartException::productNotFound($product->getId());
        }
    }


    public function getProducts(): array {
        return $this->products;
    }

    public function __toString(): string {
        return json_encode($this->toArray());
    }

    public function toArray(): array {
        return [
            'products' => array_map(fn($product) => $product->toArray(), $this->products),
        ];
    }

    public function __debugInfo(): array {
        return $this->toArray();
    }

}
