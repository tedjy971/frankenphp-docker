<?php

namespace Domain\Service;

use DateTime;
use Domain\Model\User;
use Domain\Repository\UserRepositoryInterface;
use InvalidArgumentException;

class UserService {
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function createUser(User $user): void {

        $user->setCreatedAt(new DateTime());
        $user->setUpdatedAt(new DateTime());

        try {
            $this->validateCreateUser($user);
            $this->userRepository->_save($user);

        }
        catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }

    public function validateCreateUser(User $user): void {
        if (empty($user->getFirstName())) {
            throw new InvalidArgumentException('First name cannot be empty');
        }
        if (empty($user->getLastName())) {
            throw new InvalidArgumentException('Last name cannot be empty');
        }
        if (empty($user->getEmail())) {
            throw new InvalidArgumentException('Email cannot be empty');
        }
        if (empty($user->getPassword())) {
            throw new InvalidArgumentException('Password cannot be empty');
        }
        if (!filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Invalid email');
        }
        if (strlen($user->getPassword()) < 8) {
            throw new InvalidArgumentException('Password must be at least 8 characters long');
        }
    }
}
