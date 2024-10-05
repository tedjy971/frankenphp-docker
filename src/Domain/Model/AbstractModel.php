<?php

namespace Domain\Model;

abstract class AbstractModel {

    public function __construct(array $data = []) {

        $this->hydrate($data);
    }

    public function hydrate(array $data): void {
        foreach ($data as $key => $value) {
            // One gets the setter's name matching the attribute.
            $method = 'set' . ucfirst($key);

            // If the matching setter exists
            if (method_exists($this, $method)) {
                // One calls the setter.
                $this->$method($value);
            }
        }
    }

    public function __toString(): string {
        return json_encode($this->toArray());
    }

    public function toArray(): array {
        $array = [];
        foreach ($this as $key => $value) {
            $array[$key] = $value;
        }
        return $array;
    }

    public function __debugInfo(): array {
        return $this->toArray();
    }
}
