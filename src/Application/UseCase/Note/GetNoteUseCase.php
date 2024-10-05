<?php

namespace Application\UseCase\Note;

use Domain\Model\User;
use Domain\Repository\NoteRepositoryInterface;
use Domain\Repository\UserRepositoryInterface;

 class GetNoteUseCase {

    public function __construct(private readonly NoteRepositoryInterface $noteRepositorysitory) {
    }

    /**
     * @return User[]
     */
    public function execute(User $user): array {
        return $this->noteRepositorysitory->_findByUserId($user->getId());

    }


}
