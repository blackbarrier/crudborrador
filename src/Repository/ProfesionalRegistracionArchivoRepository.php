<?php

namespace App\Repository;

use App\Entity\ProfesionalRegistracionArchivo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProfesionalRegistracionArchivo>
 *
 * @method ProfesionalRegistracionArchivo|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProfesionalRegistracionArchivo|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProfesionalRegistracionArchivo[]    findAll()
 * @method ProfesionalRegistracionArchivo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProfesionalRegistracionArchivoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProfesionalRegistracionArchivo::class);
    }

    public function add(ProfesionalRegistracionArchivo $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ProfesionalRegistracionArchivo $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ProfesionalRegistracionArchivo[] Returns an array of ProfesionalRegistracionArchivo objects
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

//    public function findOneBySomeField($value): ?ProfesionalRegistracionArchivo
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
