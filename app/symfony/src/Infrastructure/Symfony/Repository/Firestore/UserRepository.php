<?php

namespace Infrastructure\Symfony\Repository\Firestore;

use AutoMapper\AutoMapperInterface;
use Domain\Model\User as DomainUser;
use Domain\Repository\UserRepositoryInterface;
use Google\Cloud\Firestore\FirestoreClient;
use Kreait\Firebase\Contract\Firestore;

/**
 *
 */
class UserRepository implements UserRepositoryInterface {
    private const COLLECTION = 'users';
    private $dtoClass;
    private FirestoreClient $client;

    public function __construct(
        private readonly Firestore $firestore,
        private readonly AutoMapperInterface $autoMapper,
    ) {
        $this->client = $this->firestore->database();
    }

    public function _findById(int $id): ?DomainUser {

        return null;
    }

    public function _save(DomainUser $user): void {
        $normalized = $this->autoMapper->map($user, 'array');
        $client = $this->firestore->database();
        $userCollection = $client->collection('test');
        $userCollection->add($normalized);
    }

    public function _delete(DomainUser $user): void {
    }

    public function _findAll(): array {
        dd($this->database);
    }

    public function _findByName(string $name): array {
        return [];
    }

    public function _findByMail(string $getEmail): ?DomainUser {
        $collection = $this->client->collection('test');
        $doc = $collection->where('email', '==', $getEmail)->documents();

        if ($doc->isEmpty()) {
            return null;
        }

        $data= $doc->rows()[0]->data();
        dd($data);
        $DomainUser = new DomainUser($data);
        $automapper = $this->autoMapper->map($data, DomainUser::class);

        dd($automapper);


    }
}
