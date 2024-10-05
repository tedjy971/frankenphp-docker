<?php

namespace Application\UseCase\User;

use Application\DTO\Note\NoteCreateDTO;
use Domain\Model\User;
use Domain\Repository\MailerInterface;
use Domain\Repository\HashInterface;
use Domain\Repository\UserRepositoryInterface;
use Domain\Service\UserService;

readonly class RegisterUserUseCase {

    public function __construct(private UserService $userService, UserRepositoryInterface $userRepository, private MailerInterface $mailer, private HashInterface $userHash) {
    }

    public function execute(NoteCreateDTO $userDTO): User {
        /** @var string $plainPassword */
        $hashPassword = ($this->userHash->hashPassword($userDTO->plainPassword));
        $domainUser = new User([
            'firstName' => $userDTO->firstName,
            'lastName' => $userDTO->lastName,
            'email' => $userDTO->email,
            'password' => $hashPassword,
        ]);

        $this->userService->createUser($domainUser);
        $this->mailer->sendEmailConfirmation($domainUser);

        return $domainUser;
    }
}
