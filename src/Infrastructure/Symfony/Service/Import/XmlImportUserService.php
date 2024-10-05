<?php

namespace Infrastructure\Symfony\Service\Import;

use Application\DTO\User\UserCreateDTO;
use AutoMapper\AutoMapperInterface;
use Domain\Repository\ImportUserInterface;
use Exception;

class XmlImportUserService implements ImportUserInterface {

    public function __construct(private string $filePath, private AutoMapperInterface $mapper) {
    }

    /**
     * @throws Exception
     */
    public function import(): array {
        $users = [];

        if (!file_exists($this->filePath)) {
            throw new Exception("Le fichier XML n'existe pas.");
        }

        $xml = simplexml_load_file($this->filePath);
        if ($xml === false) {
            throw new Exception("Erreur lors du chargement du fichier XML.");
        }

        $json = json_encode($xml);
        $dataArray = json_decode($json, true);

        foreach ($dataArray['user'] as $userData) {
            // Utiliser l'Automapper pour mapper les données XML vers un DTO
            $userDTO = $this->mapper->map($userData, UserCreateDTO::class);
            $users[] = $userDTO;
        }

        return $users;
    }
}
