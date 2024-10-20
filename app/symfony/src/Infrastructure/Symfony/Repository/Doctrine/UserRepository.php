<?php

namespace Infrastructure\Symfony\Repository\Doctrine;

use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Model\User as DomainUser;
use Domain\Repository\UserRepositoryInterface;
use Infrastructure\Symfony\Entity\User;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface, UserRepositoryInterface {
    private $dtoClass;

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, User::class);
        $this->dtoClass = DomainUser::class;
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }


    public function _findById(int $id): ?DomainUser {

        $domainUser = $this->createQueryBuilder('u')
            ->select(['u.id', 'u.lastname', 'u.firstname', 'u.email','u.createdAt', 'u.updatedAt'])
            ->where('u.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult($this->dtoClass);


        $doctrineUser = $this->find($id);

        if (!$doctrineUser) {
            return null;
        }

//        dd($domainUser);
        return $domainUser;
    }

    public function _save(DomainUser $user): void {

        $doctrineUser = new User();
        $doctrineUser->setFirstname($user->getFirstName());
        $doctrineUser->setLastname($user->getLastName());
        $doctrineUser->setEmail($user->getEmail());
        $doctrineUser->setPassword($user->getPassword());
        $doctrineUser->setCreatedAt($user->getCreatedAt());
        $doctrineUser->setUpdatedAt($user->getUpdatedAt());

        $em = $this->getEntityManager();
        $em->persist($doctrineUser);
        $em->flush();
    }

    public function _delete(DomainUser $user): void {
        $doctrineUser = $this->find($user->getId());
        $em = $this->getEntityManager();
        $em->remove($doctrineUser);
        $em->flush();
    }

    public function _findAll(): array {
        return $this->createQueryBuilder('u')
            ->select(['u.id', 'u.lastname', 'u.firstname', 'u.email', 'u.password'])
            ->getQuery()->getResult($this->dtoClass);
    }

    public function _findByName(string $name): array {
        return [];
    }

    public function updateDate(DomainUser $user): void {
        /** @var User $doctrineUser */
        $doctrineUser = $this->find($user->getId());
        $doctrineUser->setUpdatedAt(new DateTime());

        $em = $this->getEntityManager();
        $em->persist($doctrineUser);
        $em->flush();
    }

    public function _findByMail(string $getEmail): ?\Domain\Model\User {
        $domaineUser = $this->createQueryBuilder('u')
            ->select(['u.id', 'u.lastname', 'u.firstname', 'u.email'])
            ->andWhere('u.email = :email')
            ->setParameter('email', $getEmail)
            ->getQuery()
            ->getOneOrNullResult($this->dtoClass);

        return $domaineUser;

    }
}
