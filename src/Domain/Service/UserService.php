<?php

namespace Domain\Service;

use DateTime;
use Domain\Model\User;
use Domain\Repository\UserRepositoryInterface;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

class UserService {
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }


    /**
     * @param User $user
     * @throws ValidationException
     */
    public function createUser(User $user): void {

        $user->setCreatedAt(new DateTime());
        $user->setUpdatedAt(new DateTime());

        $this->validateCreateUser($user);
        $this->userRepository->_save($user);
    }

    /**
     * @param User $user
     * @throws ValidationException
     */
    public function validateCreateUser(User $user): void {
        v::notEmpty()->check($user->getFirstName());
        v::notEmpty()->check($user->getLastName());
        v::notEmpty()->email()->check($user->getEmail());
        v::notEmpty()->length(8, 255)->check($user->getPassword());
        $existingMailUser = $this->userRepository->_findByMail($user->getEmail());
//        dd((v::not(v::exists())->setTemplate('user.mail.exists')->validate($existingMailUser)));
        v::not(v::exists())->setTemplate('user.mail.exists')->check($existingMailUser);
    }
}
