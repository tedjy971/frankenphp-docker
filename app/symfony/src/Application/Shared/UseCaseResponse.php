<?php

namespace Application\Shared;

use Exception;

class UseCaseResponse {
    private bool $success;
    private ?string $message = null;
    private array $errors = [];
    private $data;
    private ?Exception $exception = null;

    public function isSuccess(): bool {
        return $this->success;
    }

    public function setSuccess(bool $success): void {
        $this->success = $success;
    }

    public function getMessage(): ?string {
        return $this->message;
    }

    public function setMessage(string $message): void {
        $this->message = $message;
    }

    public function getErrors(): array {
        return $this->errors;
    }

    public function setErrors(array $errors): void {
        $this->errors = $errors;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data): void {
        $this->data = $data;
    }

    public function getException(): ?Exception {
        return $this->exception;
    }

    public function setException(Exception $exception): void {
        $this->exception = $exception;
    }
}
