<?php

namespace App\Repository;

use App\Entity\ProfesionalEspecialista;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProfesionalEspecialista>
 *
 * @method ProfesionalEspecialista|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProfesionalEspecialista|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProfesionalEspecialista[]    findAll()
 * @method ProfesionalEspecialista[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfesionalEspecialistaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProfesionalEspecialista::class);
    }

    public function add(ProfesionalEspecialista $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ProfesionalEspecialista $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ProfesionalEspecialista[] Returns an array of ProfesionalEspecialista objects
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

//    public function findOneBySomeField($value): ?ProfesionalEspecialista
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
