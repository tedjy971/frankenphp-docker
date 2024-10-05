<?php

namespace Application\UseCase\Note;

use Application\DTO\Note\NoteCreateDTO;
use Domain\Model\User;
use Domain\Service\NoteService;

readonly class CreateNoteUseCase {

    public function __construct(private NoteService $noteService) {
    }

    public function execute(NoteCreateDTO $noteCreateDTO, User $user): void {
        $this->noteService->createNote($noteCreateDTO, $user);
    }
}
