<?php

namespace Infrastructure\Symfony\Repository\Firestore;

use AutoMapper\AutoMapperInterface;
use Domain\Model\User as DomainUser;
use Domain\Repository\UserRepositoryInterface;
use Infrastructure\Symfony\Document\User;
use Kreait\Firebase\Contract\Firestore;

class UserRepository implements UserRepositoryInterface {
    private const COLLECTION = 'users';
    private $dtoClass;

    public function __construct(
        private readonly Firestore $firestore,
        private AutoMapperInterface $autoMapper
    ) {
    }

    public function _findById(int $id): ?DomainUser {

        return null;
    }

    public function _save(DomainUser $user): void {
        $normalized = $this->autoMapper->map($user, 'array');
//        dd($normalized);
        $this->firestore->database()->collection(self::COLLECTION)->document($user->getId())->set($normalized);
//        $this->documentManager->persist($documentUser);
//        $this->documentManager->flush();
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
