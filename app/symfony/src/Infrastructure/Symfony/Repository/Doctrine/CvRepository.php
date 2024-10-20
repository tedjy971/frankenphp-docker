<?php

namespace Infrastructure\Symfony\Repository\Doctrine;

use AutoMapper\AutoMapper;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Model\CV;
use Domain\Repository\CvRepositoryInterface;
use Infrastructure\Symfony\Entity\Product;

/**
 * @extends ServiceEntityRepository<CV>
 * @method CV|null find($id, $lockMode = null, $lockVersion = null)
 * @method CV|null findOneBy(array $criteria, array $orderBy = null)
 * @method CV[]    findAll()
 * @method CV[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CvRepository extends ServiceEntityRepository implements CvRepositoryInterface {

    private $dtoClass;
    private EntityManagerInterface $em;

    public function __construct(ManagerRegistry $registry, private readonly AutoMapper $autoMapper, private readonly UserRepository $userRepository) {
        parent::__construct($registry, Product::class);
        $this->dtoClass = \Domain\Model\Product::class;
        $this->em = $this->getEntityManager();
    }

    public function save(CV $cv): void {
        $doctrineCV = $this->toDoctrine($cv);
        $this->em->persist($doctrineCV);
        $this->em->flush();
    }


    private function toDoctrine(CV $cv): DoctrineCV {
        $doctrineCV = new DoctrineCV();
        $doctrineCV->setFullName($cv->getFullName());
        $doctrineCV->setEmail($cv->getEmail());
        $doctrineCV->setEducations(new ArrayCollection($cv->getEducations()));
        $doctrineCV->setExperiences(new ArrayCollection($cv->getExperiences()));
        $doctrineCV->setSkills(new ArrayCollection($cv->getSkills()));
        return $doctrineCV;
    }

    public function findById(int $id): ?CV {
        $doctrineCV = $this->entityManager->find(DoctrineCV::class, $id);
        return $doctrineCV ? $this->toDomain($doctrineCV) : null;
    }

    private function toDomain(DoctrineCV $doctrineCV): CV {
        $cv = new CV();
        $cv->setFullName($doctrineCV->getFullName());
        $cv->setEmail($doctrineCV->getEmail());
        foreach ($doctrineCV->getEducations() as $education) {
            $cv->addEducation($education);
        }
        foreach ($doctrineCV->getExperiences() as $experience) {
            $cv->addExperience($experience);
        }
        foreach ($doctrineCV->getSkills() as $skill) {
            $cv->addSkill($skill);
        }
        return $cv;
    }

    public function _findById(int $id): ?Cv {
        // TODO: Implement _findById() method.
    }

    public function _save(CV $cv): void {
        // TODO: Implement _save() method.
    }

    public function _delete(CV $cv): void {
        // TODO: Implement _delete() method.
    }

    public function _findByName(string $name): array {
        // TODO: Implement _findByName() method.
    }

    public function _findByMail(string $getEmail) {
        // TODO: Implement _findByMail() method.
    }

}
