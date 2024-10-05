<?php

namespace Domain\Repository;

use Domain\Model\User;

interface UserRepositoryInterface {
    public function _findById(int $id): ?User;

    public function _save(User $user): void;

    public function _delete(User $user): void;

    /**
     * @return array<User>
     */
    public function _findAll(): array;

    public function _findByName(string $name): array;
}
