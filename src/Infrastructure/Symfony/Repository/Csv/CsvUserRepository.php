<?php

namespace Infrastructure\Symfony\Repository\Csv;

use Domain\Model\User;
use League\Csv\CannotInsertRecord;
use League\Csv\Exception;
use League\Csv\InvalidArgument;
use League\Csv\Reader;
use League\Csv\SyntaxError;
use League\Csv\UnableToProcessCsv;
use League\Csv\UnavailableStream;
use League\Csv\Writer;
use League\Csv\Statement;
use ReflectionException;

class CsvUserRepository {
    private string $filePath;

    public function __construct(string $filePath) {
        $this->filePath = $filePath;
    }

    /**
     * @throws UnableToProcessCsv
     * @throws InvalidArgument
     * @throws UnavailableStream
     * @throws ReflectionException
     * @throws SyntaxError
     * @throws Exception
     */
    public function findById(int $id): ?User {
        $csv = Reader::createFromPath($this->filePath, 'r');
        $csv->setHeaderOffset(0);
        $stmt = (new Statement())->where(function (array $record) use ($id) {
            return (int)$record['id'] === $id;
        });

        $result = $stmt->process($csv);
        $record = $result->fetchOne();

        if (!$record) {
            return null;
        }

        return new User((int)$record['id'], $record['name'], $record['email'], $record['password']);
    }

    /**
     * @throws UnavailableStream
     * @throws CannotInsertRecord
     * @throws Exception
     */
    public function save(User $user): void {
        if ($user->getId() === null) {
            $user->setId($this->generateNextId());
        }

        $csv = Writer::createFromPath($this->filePath, 'a+');
        $csv->insertOne([$user->getId(), $user->getFirstName(), $user->getLastName(), $user->getEmail(), $user->getPassword()]);
    }

    /**
     * @throws UnavailableStream
     * @throws Exception
     */
    private function generateNextId(): int {
        $users = $this->_findAll();

        if (empty($users)) {
            return 1; // Premier utilisateur
        }

        // Récupérer le plus grand ID et ajouter 1
        $maxId = max(array_map(function ($user) {
            return $user->getId();
        }, $users));

        return $maxId + 1;
    }

    /**
     * @throws UnavailableStream
     * @throws Exception
     */
    public function _findAll(): array {
        $csv = Reader::createFromPath($this->filePath, 'r');
        $csv->setHeaderOffset(0);  // Assurez-vous que le fichier CSV a un en-tête : id, name, email, password
        $records = $csv->getRecords();

        $users = [];
        foreach ($records as $record) {
            $users[] = new User([
                    'id' => (int)$record['id'],
                    'firstname' => $record['firstname'],
                    'lastname' => $record['lastname'],
                    'email' => $record['email'],
                    'password' => $record['password']  // Inclure le mot de passe
                ]
            );
        }
        return $users;
    }

    /**
     * @throws UnavailableStream
     * @throws CannotInsertRecord
     * @throws Exception
     */
    public function delete(User $user): void {
        $users = $this->_findAll();
        $filteredUsers = array_filter($users, function ($u) use ($user) {
            return $u->getId() !== $user->getId();
        });

        $this->overwriteCsv($filteredUsers);
    }

    /**
     * @throws UnavailableStream
     * @throws CannotInsertRecord
     * @throws Exception
     */
    private function overwriteCsv(array $users): void {
        $csv = Writer::createFromPath($this->filePath, 'w+');
        $csv->insertOne(['id', 'name', 'email', 'password']);  // Ligne d'en-tête

        foreach ($users as $user) {
            $csv->insertOne([$user->getId(), $user->getName(), $user->getEmail(), $user->getPassword()]);
        }
    }

    /**
     * @throws UnavailableStream
     * @throws InvalidArgument
     * @throws ReflectionException
     * @throws SyntaxError
     * @throws Exception
     */
    public function findByName(string $name): array {
        return $this->findByField('name', $name);
    }

    /**
     * @throws UnavailableStream
     * @throws InvalidArgument
     * @throws ReflectionException
     * @throws SyntaxError
     * @throws Exception
     */
    private function findByField(string $field, string $value): array {
        $csv = Reader::createFromPath($this->filePath, 'r');
        $csv->setHeaderOffset(0);
        $stmt = (new Statement())->where(function (array $record) use ($field, $value) {
            return $record[$field] === $value;
        });

        $result = $stmt->process($csv);
        $users = [];
        foreach ($result as $record) {
            $users[] = new User(
                [
                    'id' => $record['id'],
                    'email' => $record['email'],
                    'password' => $record['password'],
                    'created_at' => $record['created_at'],
                    'updated_at' => $record['updated_at'],
                    'lastname' => $record['lastname'],
                    'firstname' => $record['firstname'],
                    'roles' => $record['roles'],
                    'is_verified' => $record['is_verified'],
                ]
            );
        }

        return $users;
    }

    /**
     * @throws UnavailableStream
     * @throws InvalidArgument
     * @throws ReflectionException
     * @throws SyntaxError
     * @throws Exception
     */
    public function findByEmail(string $email): array {
        return $this->findByField('email', $email);
    }

    public function findByNameAndEmail(string $name, string $email): array {
        return $this->findByFields(['name' => $name, 'email' => $email]);
    }

    /**
     * @throws InvalidArgument
     * @throws UnavailableStream
     * @throws ReflectionException
     * @throws SyntaxError
     * @throws Exception
     */
    private function findByFields(array $fields): array {
        $csv = Reader::createFromPath($this->filePath, 'r');
        $csv->setHeaderOffset(0);
        $stmt = (new Statement())->where(function (array $record) use ($fields) {
            foreach ($fields as $field => $value) {
                if ($record[$field] !== $value) {
                    return false;
                }
            }

            return true;
        });

        $result = $stmt->process($csv);
        $users = [];
        foreach ($result as $record) {
            $users[] = new User(
                (int)$record['id'],
                $record['name'],
                $record['email'],
                $record['password']  // Inclure le mot de passe
            );
        }

        return $users;
    }
}
