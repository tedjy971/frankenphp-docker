<?php

namespace Application\DTO;

/**
 * All properties of DTO must be public
 */
abstract class AbstractDTO {

    public function toDomain(string $class): mixed {
        return new $class($this->toArray());
    }

    public function toArray(): array {
        return get_object_vars($this);
    }
}
