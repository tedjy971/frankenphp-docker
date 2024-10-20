<?php
declare(strict_types=1);

namespace Infrastructure\Symfony\Hydrator;


use Doctrine\ORM\EntityManagerInterface;
use Domain\Model\Note as DomainNote;

class NoteHydrator extends AbstractHydrator {

    public function __construct(EntityManagerInterface $em, string $dtoClass = DomainNote::class) {
        parent::__construct($em, $dtoClass);
    }
}
