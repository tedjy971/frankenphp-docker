<?php

namespace Application\DTO\Note;
use Application\DTO\AbstractDTO;

class NoteUpdateDTO extends AbstractDTO {
    public ?string $id = null;
    public ?string $title = null;
    public ?string $content = null;
}
