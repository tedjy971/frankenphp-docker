<?php

namespace Domain\Repository;


use Domain\Model\Note;

interface NoteRepositoryInterface {
    public function _findById(int $id): ?Note;

    public function _save(Note $note): void;

    public function _delete(Note $note): void;

    public function _update(Note $note): void;

    /**
     * @return array<Note>
     */
    public function _findAll(): array;

    public function _findByName(string $name): array;

    /**
     * @return array<Note>
     */
    public function _findByUserId($userId): array;
}
