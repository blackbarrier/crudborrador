<?php

namespace App\Repository;

use App\Entity\PersonaDomicilio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PersonaDomicilio>
 *
 * @method PersonaDomicilio|null find($id, $lockMode = null, $lockVersion = null)
 * @method PersonaDomicilio|null findOneBy(array $criteria, array $orderBy = null)
 * @method PersonaDomicilio[]    findAll()
 * @method PersonaDomicilio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonaDomicilioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PersonaDomicilio::class);
    }

    public function add(PersonaDomicilio $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PersonaDomicilio $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return PersonaDomicilio[] Returns an array of PersonaDomicilio objects
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

//    public function findOneBySomeField($value): ?PersonaDomicilio
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
