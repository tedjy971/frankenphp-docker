<?php

namespace Infrastructure\Symfony\Service\Import;

use Application\DTO\User\UserCreateDTO;
use AutoMapper\AutoMapper;
use AutoMapper\AutoMapperInterface;
use Domain\Repository\ImportUserInterface;
use Exception;
use League\Csv\InvalidArgument;
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\SyntaxError;
use League\Csv\UnavailableStream;

class CsvImportUserService implements ImportUserInterface {

    public function __construct(private readonly string $filePath, private AutoMapper $mapper) {
    }

    /**
     * @throws UnavailableStream
     * @throws InvalidArgument
     * @throws SyntaxError
     * @throws \League\Csv\Exception
     * @throws Exception
     */
    public function import(): array {
        $users = [];

        if (!file_exists($this->filePath)) {
            throw new Exception("Le fichier CSV n'existe pas.");
        }

        $csv = Reader::createFromPath($this->filePath, 'r');
        $csv->setHeaderOffset(0); // Indique que la première ligne contient les en-têtes

        $stmt = (new Statement());
        $records = $stmt->process($csv);

        $autoMapper = AutoMapper::create();
        foreach ($records as $record) {
            $userDTO = $autoMapper->map($record, UserCreateDTO::class);
            $users[] = $userDTO;
        }

        return $users;
    }
}
