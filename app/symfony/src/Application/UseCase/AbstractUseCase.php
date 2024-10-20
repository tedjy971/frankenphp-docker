<?php

namespace Application\UseCase;

use Application\Shared\UseCaseException;
use Application\Shared\UseCaseResponse;
use Respect\Validation\Exceptions\ValidationException;

abstract class AbstractUseCase {
    protected UseCaseResponse $response;

    public function __construct() {
        $this->response = new UseCaseResponse();
    }

    public function execute( mixed $useCaseInput = null): UseCaseResponse {
        $this->response->setSuccess(true);
        try {
            $this->executeUseCase($useCaseInput);
        }
        catch (ValidationException $e) {
            // Gère les erreurs de validation (domain)
            $this->response->setSuccess(false);
            $this->response->setMessage('Validation failed');
            $this->response->setErrors($e->getMessages());
        }
        catch (UseCaseException $e) {
            $this->response->setSuccess(false);
            $this->response->setMessage('Business logic error: ' . $e->getMessage());
        }
//        catch (Exception $e) {
//            // Gère toutes les autres exceptions inattendues
//            $this->response->setSuccess(false);
//            $this->response->setMessage('An unexpected error occurred');
//            $this->response->setException($e);  // Tu peux éventuellement capturer l'exception pour un log ou autre traitement
//        }

        // Pas de catch pour les exceptions d'infrastructure ou autres exceptions générales
        // Ces exceptions remonteront et seront gérées par le listener Symfony
        return $this->response;
    }

    abstract protected function executeUseCase(mixed $useCaseInput = null): void;
}
