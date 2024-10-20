<?php


namespace Application\DTO\Note;

use Application\DTO\AbstractDTO;

class NoteCreateDTO extends AbstractDTO {

    public string $title;
    public string $content;

    public function __construct() {
    }
}

