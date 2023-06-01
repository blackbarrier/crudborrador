<?php

namespace App\Repository;

use App\Entity\PartidoPorDistrito;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PartidoPorDistrito>
 *
 * @method PartidoPorDistrito|null find($id, $lockMode = null, $lockVersion = null)
 * @method PartidoPorDistrito|null findOneBy(array $criteria, array $orderBy = null)
 * @method PartidoPorDistrito[]    findAll()
 * @method PartidoPorDistrito[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartidoPorDistritoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PartidoPorDistrito::class);
    }

    public function add(PartidoPorDistrito $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PartidoPorDistrito $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return PartidoPorDistrito[] Returns an array of PartidoPorDistrito objects
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

//    public function findOneBySomeField($value): ?PartidoPorDistrito
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
