<?php

namespace Domain\Service;

use Application\DTO\Note\NoteCreateDTO;
use DateTime;
use Domain\Model\Note;
use Domain\Model\User;
use Domain\Repository\NoteRepositoryInterface;
use InvalidArgumentException;

readonly class NoteService {

    public function __construct(private NoteRepositoryInterface $noteRepository) {
    }

    public function createNote(NoteCreateDTO $noteDTO, User $user): void {

        /** @var Note $note */
        $note = $noteDTO->toDomain(Note::class);
        $note->setCreatedAt(new DateTime());
        $note->setUpdatedAt(new DateTime());
        $note->setUser($user);
        try {
            $this->validateNote($note);
            $this->noteRepository->_save($note);
        }
        catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }


    private function validateNote(Note $note): void {
        if ($note->getContent() === '') {
            throw new InvalidArgumentException('Le contenu du note est obligatoire');
        }
        if ($note->getTitle() === '') {
            throw new InvalidArgumentException('Le titre du note est obligatoire');
        }
        if (empty($note->getUser())) {
            throw new InvalidArgumentException('Un utilisateur doit être associé
            à la note');
        }
    }
}
