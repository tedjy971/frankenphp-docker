<?php
declare(strict_types=1);

namespace Infrastructure\Symfony\Hydrator;


use Doctrine\ORM\EntityManagerInterface;
use Domain\Model\Product as DomainProduct;

class ProductHydrator extends AbstractHydrator {

    public function __construct(EntityManagerInterface $em, string $dtoClass = DomainProduct::class) {
        parent::__construct($em, $dtoClass);
    }
}
