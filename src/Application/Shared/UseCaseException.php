<?php

namespace Application\Shared;

use Exception;

class UseCaseException extends Exception
{
    private array $errors = [];

    public function __construct(string $message = "", array $errors = [], int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->errors = $errors;
    }

    /**
     * Retourne les erreurs liées au Use Case.
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Définit les erreurs pour le Use Case.
     *
     * @param array $errors
     */
    public function setErrors(array $errors): void
    {
        $this->errors = $errors;
    }
}

