<?php

namespace Infrastructure\Symfony\Repository\Doctrine;

use AutoMapper\AutoMapper;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Repository\ProductRepositoryInterface;
use Infrastructure\Symfony\Entity\Product;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository implements ProductRepositoryInterface {

  private string $dtoClass;

  public function __construct(ManagerRegistry $registry, private readonly AutoMapper $autoMapper, private readonly UserRepository $userRepository) {
    parent::__construct($registry, Product::class);
    $this->dtoClass = \Domain\Model\Product::class;
  }

  public function _save(\Domain\Model\Product $product): void {
    $doctrineUser = $this->userRepository->find($product->getMarketer()->getId());

    $doctrineProduct = $this->autoMapper->map($product, Product::class);
    $doctrineProduct->setUser($doctrineUser);


    $em = $this->getEntityManager();
    $em->persist($doctrineProduct);

    $em->flush();
  }

  public function _findById(int $id): ?\Domain\Model\Product {

    /** @var \Domain\Model\Product $product */
    $product = $this->createQueryBuilder('p')
      ->select(['p.id', 'p.name', 'p.description', 'p.price', 'p.user AS marketer'])
      ->andWhere('p.id = :id')
      ->setParameter('id', $id)
      ->getQuery()
      ->getOneOrNullResult($this->dtoClass);


    return $product;
  }

  public function _delete(\Domain\Model\Product $user): void {
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

  public function _update(\Domain\Model\Product $Product): void {
    $doctrineNote = $this->find($Product->getId());
    $doctrineNote->setTitle($Product->getTitle());
    $doctrineNote->setContent($Product->getContent());
    $doctrineNote->setUpdatedAt($Product->getUpdatedAt());

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
