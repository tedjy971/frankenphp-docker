<?php

namespace Domain\Repository;


use Domain\Model\Product;

interface ProductRepositoryInterface {
    public function _findById(int $id): ?Product;

    public function _save(Product $Product): void;

    public function _delete(Product $Product): void;

    public function _update(Product $Product): void;

    /**
     * @return array<Product>
     */
    public function _findAll(): array;

    public function _findByName(string $name): array;

    /**
     * @return array<Product>
     */
    public function _findByUserId($userId): array;
}
