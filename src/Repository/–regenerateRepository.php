<?php

namespace App\Repository;

use App\Entity\–regenerate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method –regenerate|null find($id, $lockMode = null, $lockVersion = null)
 * @method –regenerate|null findOneBy(array $criteria, array $orderBy = null)
 * @method –regenerate[]    findAll()
 * @method –regenerate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class –regenerateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, –regenerate::class);
    }

    // /**
    //  * @return –regenerate[] Returns an array of –regenerate objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('�')
            ->andWhere('�.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('�.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?–regenerate
    {
        return $this->createQueryBuilder('�')
            ->andWhere('�.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
