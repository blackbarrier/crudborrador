<?php

namespace App\Repository;

use App\Entity\ProfesionAlcance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProfesionAlcance>
 *
 * @method ProfesionAlcance|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProfesionAlcance|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProfesionAlcance[]    findAll()
 * @method ProfesionAlcance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfesionAlcanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProfesionAlcance::class);
    }

    public function add(ProfesionAlcance $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ProfesionAlcance $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ProfesionAlcance[] Returns an array of ProfesionAlcance objects
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

//    public function findOneBySomeField($value): ?ProfesionAlcance
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
