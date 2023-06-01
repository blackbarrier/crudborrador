<?php

namespace App\Repository;

use App\Entity\ProfesionalRegistracion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProfesionalRegistracion>
 *
 * @method ProfesionalRegistracion|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProfesionalRegistracion|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProfesionalRegistracion[]    findAll()
 * @method ProfesionalRegistracion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfesionalRegistracionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProfesionalRegistracion::class);
    }

    public function add(ProfesionalRegistracion $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ProfesionalRegistracion $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ProfesionalRegistracion[] Returns an array of ProfesionalRegistracion objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ProfesionalRegistracion
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
