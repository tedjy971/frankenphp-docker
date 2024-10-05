<?php

namespace Domain\Exception;

class CartException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }

    public static function productNotFound(int $productId): self
    {
        return new self(sprintf('Product with id %d not found', $productId));
    }

    public static function quantityMustBeGreaterThanZero(): self
    {
        return new self('Quantity must be greater than 0');
    }

    public static function productAlreadyExists(int $productId): self
    {
        return new self(sprintf('Product with id %d already exists in cart', $productId));
    }

}
