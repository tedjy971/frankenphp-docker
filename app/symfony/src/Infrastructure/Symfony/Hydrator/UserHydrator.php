<?php
declare(strict_types=1);

namespace Infrastructure\Symfony\Hydrator;


use Doctrine\ORM\EntityManagerInterface;
use Domain\Model\User as DomainUser;

class UserHydrator extends AbstractHydrator {

    public function __construct(EntityManagerInterface $em, string $dtoClass = DomainUser::class) {
        parent::__construct($em, $dtoClass);
    }
}
