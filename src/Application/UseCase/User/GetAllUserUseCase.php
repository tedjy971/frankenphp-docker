<?php

namespace Application\UseCase\User;

use Domain\Model\User;
use Domain\Repository\UserRepositoryInterface;

readonly class GetAllUserUseCase {

    public function __construct(private UserRepositoryInterface $userRepository) {
    }

    /**
     * @return User[]
     */
    public function execute(): array {

        $users = $this->userRepository->_findAll();

        foreach ($users as $user) {
            $this->userRepository->updateDate($user);
        }

        return $users;
    }


}
