<?php

namespace App\Repository;

use App\Entity\EvenementFoot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EvenementFoot|null find($id, $lockMode = null, $lockVersion = null)
 * @method EvenementFoot|null findOneBy(array $criteria, array $orderBy = null)
 * @method EvenementFoot[]    findAll()
 * @method EvenementFoot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvenementFootRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EvenementFoot::class);
    }


    // /**
    //  * @return EvenementFoot[] Returns an array of EvenementFoot objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EvenementFoot
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
