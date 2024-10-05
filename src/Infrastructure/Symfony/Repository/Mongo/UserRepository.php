<?php

namespace Infrastructure\Symfony\Repository\Mongo;

use AutoMapper\AutoMapperInterface;
use Doctrine\ODM\MongoDB\DocumentManager;
use Domain\Model\User as DomainUser;
use Domain\Repository\UserRepositoryInterface;
use Infrastructure\Symfony\Document\User;

class UserRepository implements UserRepositoryInterface {
    private const COLLECTION = 'users';
    private $dtoClass;

    public function __construct(
        private readonly DocumentManager $documentManager,
        private AutoMapperInterface $autoMapper
    ) {
    }

    public function _findById(int $id): ?DomainUser {

        return null;
    }

    public function _save(DomainUser $user): void {
        $documentUser = $this->autoMapper->map($user, User::class);
        $this->documentManager->persist($documentUser);
        $this->documentManager->flush();
    }

    public function _delete(DomainUser $user): void {
    }

    public function _findAll(): array {
        dd($this->database);
    }

    public function _findByName(string $name): array {
        return [];
    }


    public function _findByMail(string $getEmail): ?DomainUser {
        return null;
    }
}
