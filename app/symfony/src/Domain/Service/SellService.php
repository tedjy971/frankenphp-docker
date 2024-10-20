<?php

namespace Domain\Service;

use Application\DTO\Product\ProductCreateDTO;
use Domain\Model\Product;
use Respect\Validation\Validator as v;

class SellService {

    public function __construct() {
    }

    public function generateProductToAdd(ProductCreateDTO $productToAdd, $TVA): Product {

        /** @var Product $product */
        $product = $productToAdd->toDomain(Product::class);
        $product->calculateTaxSellingPrice($TVA);
        $product->hide();

        return $product;
    }

    public function validateCreateProduct(ProductCreateDTO $product): void {
        v::stringType()->notEmpty()->check($product->name);
        v::stringType()->notEmpty()->check($product->description);
        v::floatType()->notEmpty()->check($product->price);
//        v::intType()->notEmpty()->check($product->stock);
//        v::boolType()->notEmpty()->check($product->visible);
        v::intType()->notEmpty()->check($product->marketer->getId());
    }
}
