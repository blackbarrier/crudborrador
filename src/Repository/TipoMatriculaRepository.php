<?php

namespace App\Repository;

use App\Entity\TipoMatricula;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TipoMatricula>
 *
 * @method TipoMatricula|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoMatricula|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoMatricula[]    findAll()
 * @method TipoMatricula[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoMatriculaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoMatricula::class);
    }

    public function add(TipoMatricula $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(TipoMatricula $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return TipoMatricula[] Returns an array of TipoMatricula objects
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

//    public function findOneBySomeField($value): ?TipoMatricula
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
