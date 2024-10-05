<?php

namespace Application\UseCase\Import;

use Application\UseCase\AbstractUseCase;
use Domain\Model\User;
use Domain\Repository\ImportUserInterface;
use Domain\Repository\UserRepositoryInterface;
use Domain\Service\UserService;
use Respect\Validation\Exceptions\ValidationException;

class ImportUserUseCase extends AbstractUseCase {
    public function __construct(
        private readonly ImportUserInterface $importUserService,
        private readonly UserService $userService
    ) {
        parent::__construct();
    }

    protected function executeUseCase(mixed $useCaseInput = null): void {
        $usersDTO = $this->importUserService->import();

        foreach ($usersDTO as $userDTO) {
            try {
                $user = $userDTO->toDomain(User::class);
                $user->setPassword($userDTO->plainPassword);

                // Tentative de création de l'utilisateur
                $this->userService->createUser($user);
            }
            catch (ValidationException $e) {
                dd($e);
                // Stocker l'erreur pour cet utilisateur
                $errors[] = [
                    'user' => $userDTO,
                    'error' => $e->getMessage(),
                ];
            }
        }

        if (!empty($errors)) {
            $this->response->setMessage('Importation Terminée avec erreurs');
            $this->response->setErrors($errors);
            $this->response->setSuccess(false);
        }
        else {
            $this->response->setMessage('Importation réussie');
        }
    }
}
