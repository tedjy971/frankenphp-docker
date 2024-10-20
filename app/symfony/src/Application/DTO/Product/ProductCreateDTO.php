<?php


namespace Application\DTO\Product;

use Application\DTO\AbstractDTO;
use Domain\Model\User;

class ProductCreateDTO extends AbstractDTO {

    public string $name;
    public string $description;
    public float $price;
    public int $stock;
//    public ?User $marketer;
    public User $marketer;

    public function __construct() {
    }
}

