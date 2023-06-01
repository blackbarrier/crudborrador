<?php

namespace App\Repository;

use App\Entity\OrigenRegistracion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrigenRegistracion>
 *
 * @method OrigenRegistracion|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrigenRegistracion|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrigenRegistracion[]    findAll()
 * @method OrigenRegistracion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrigenRegistracionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrigenRegistracion::class);
    }

    public function add(OrigenRegistracion $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(OrigenRegistracion $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return OrigenRegistracion[] Returns an array of OrigenRegistracion objects
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

//    public function findOneBySomeField($value): ?OrigenRegistracion
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
