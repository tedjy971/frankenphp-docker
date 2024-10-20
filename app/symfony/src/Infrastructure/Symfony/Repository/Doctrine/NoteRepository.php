<?php

namespace Infrastructure\Symfony\Repository\Doctrine;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Repository\NoteRepositoryInterface;
use Infrastructure\Symfony\Entity\Note;

/**
 * @extends ServiceEntityRepository<Note>
 *     @method Note|null find($id, $lockMode = null, $lockVersion = null)
 *     @method Note|null findOneBy(array $criteria, array $orderBy = null)
 *     @method Note[]    findAll()
 *     @method Note[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoteRepository extends ServiceEntityRepository implements NoteRepositoryInterface {

    private string $dtoClass;

    public function __construct(ManagerRegistry $registry, private readonly UserRepository $userRepository) {
        parent::__construct($registry, Note::class);
        $this->dtoClass = Note::class;
    }

    public function _save(\Domain\Model\Note $note): void {
        $doctrineUser = $this->userRepository->find($note->getUser()->getId());

        $doctrineNote = new Note();
        $doctrineNote->setTitle($note->getTitle());
        $doctrineNote->setContent($note->getContent());
        $doctrineNote->setUser($doctrineUser);
        $doctrineNote->setCreatedAt($note->getCreatedAt());
        $doctrineNote->setUpdatedAt($note->getUpdatedAt());

        $em = $this->getEntityManager();
        $em->persist($doctrineNote);

//        dd($doctrineNote);
        $em->flush();
    }

    public function _findById(int $id): ?\Domain\Model\Note {
        // TODO: Implement _findById() method.
    }

    public function _delete(\Domain\Model\Note $user): void {
        // TODO: Implement _delete() method.
    }

    public function _findAll(): array {

        return $this->createQueryBuilder('n')
            ->getQuery()
            ->getResult($this->dtoClass);
    }

    public function _findByName(string $name): array {
        return $this->createQueryBuilder('n')
            ->andWhere('n.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getResult($this->dtoClass);
    }

    public function _update(\Domain\Model\Note $note): void {
        $doctrineNote = $this->find($note->getId());
        $doctrineNote->setTitle($note->getTitle());
        $doctrineNote->setContent($note->getContent());
        $doctrineNote->setUpdatedAt($note->getUpdatedAt());

        $this->getEntityManager()->persist($doctrineNote);
        $this->getEntityManager()->flush();
    }

    public function _findByUserId($userId): array {
        return $this->createQueryBuilder('n')
            ->andWhere('n.userId = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getResult($this->dtoClass);

    }
}
