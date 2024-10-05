<?php

namespace Application\UseCase\User;

use Application\DTO\User\NoteCreateDTO;
use Application\DTO\User\UserDTO;
use Domain\Model\User;
use Domain\Repository\MailerInterface;
use Domain\Repository\UserRepositoryInterface;
use Domain\Service\UserService;

readonly class CreateNoteUseCase {

    public function __construct(private UserService $userService, UserRepositoryInterface $userRepository, private MailerInterface $mailer) {
    }

    public function execute(NoteCreateDTO $userDTO) {
        $userDomain = $userDTO->toDomain(User::class);

        $this->userService->createUser($userDomain);
        //Send mail to user

        $this->mailer->sendEmail($userDomain->getEmail(), 'Welcome', 'Welcome to our platform');
    }
}
