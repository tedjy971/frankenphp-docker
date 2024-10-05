<?php

namespace Domain\Model;

class Product {


    public function __construct(private int $id, private string $name, private float $price) {

    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id
     * return Product
     */
    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function setPrice(float $price): void {
        $this->price = $price;
    }

    public function __toString(): string {
        return json_encode($this->toArray());
    }

    public function toArray(): array {
        return [
            'name' => $this->name,
            'price' => $this->price,
        ];
    }

    public function __debugInfo(): array {
        return $this->toArray();
    }
}
