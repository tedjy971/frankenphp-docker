<?php

namespace Infrastructure\Symfony\Entity;

use AutoMapper\AutoMapper;

abstract class AbstractEntity {

    public function __construct(?array $array = []) {
        $this->hydrate($array);
    }

    private function hydrate(array $data): void {
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


    /**
     * Docs: https://automapper.jolicode.com/latest/#further-reading
     * https://automapper.jolicode.com/latest/getting-started/context/
     * @param string $target
     * @param array $context
     * @return array|object|null
     */
    public function toObject(string $target, array $context = []): object|array|null {
        $automapper = AutoMapper::create();

        return $automapper->map($this, $target, $context);
    }
}
