<?php

namespace Domain\Model;

class Product extends AbstractModel {

    public const float TVA = 0.2;

    private int $stock = 0;

    private bool $visible = false;

//    private $category_id = null;
    private ?int $id = null;
    private ?string $name = null;
    private ?float $priceTTC = null;
    private ?float $price = null;
    private ?string $description = null;
    private User $marketer;

    public function getPriceTTC(): ?float {
        return $this->priceTTC;
    }

    public function setPriceTTC(?float $priceTTC): self {
        $this->priceTTC = $priceTTC;
        return $this;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): self {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(?string $name): self {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function setDescription(?string $description): self {
        $this->description = $description;
        return $this;
    }

    public function getStock(): int {
        return $this->stock;
    }

    public function setStock(int $stock): self {
        $this->stock = $stock;
        return $this;
    }

    public function isVisible(): bool {
        return $this->visible;
    }

    public function setVisible(bool $visible): self {
        $this->visible = $visible;
        return $this;
    }

    public function getMarketer(): User {
        return $this->marketer;
    }

    public function setMarketer(User $marketer): self {
        $this->marketer = $marketer;
        return $this;
    }

    public function hide(): void {
        $this->setVisible(false);
    }

    public function display(): void {
        $this->setVisible(true);
    }

    public function calculateTaxSellingPrice($vatRate): void {
        $this->setPriceTTC($this->getPrice() * (1 + $vatRate));
    }

    public function getPrice(): ?float {
        return $this->price;
    }

    public function setPrice(?float $price): self {
        $this->price = $price;
        return $this;
    }
}
