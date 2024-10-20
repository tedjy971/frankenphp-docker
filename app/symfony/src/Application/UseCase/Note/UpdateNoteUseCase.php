<?php

namespace Application\UseCase\Note;

use Application\DTO\Note\NoteCreateDTO;
use Application\DTO\Note\NoteUpdateDTO;
use DateTime;
use Domain\Model\User;
use Domain\Repository\NoteRepositoryInterface;
use Domain\Service\NoteService;

readonly class UpdateNoteUseCase {

    public function __construct(private NoteService $noteService, private NoteRepositoryInterface $noteRepository) {
    }

    public function execute(NoteUpdateDTO $noteUpdateDTO): void {

        $domainUser = $this->noteRepository->_findById($noteUpdateDTO->id);
        $domainUser->setTitle($noteUpdateDTO->title);
        $domainUser->setContent($noteUpdateDTO->content);
        $domainUser->setUpdatedAt(new DateTime());

        $this->noteRepository->_update($domainUser);

    }
}
