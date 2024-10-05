<?php

namespace Application\DTO;
abstract class AbstractDTO {

    public function toDomain(string $class): mixed {
        return new $class($this->toArray());
    }

    public function toArray(): array {
        return get_object_vars($this);
    }
}
