<?php

namespace Infrastructure\Symfony\Service;

use Domain\Model\User;
use Domain\Repository\HashInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

readonly class HashService implements HashInterface {

    public function __construct(private UserPasswordHasherInterface $hasher) {
    }

    public function hashPassword(string $password): string {
        $user = new User();
        return $this->hasher->hashPassword($user, $password);
    }
}
