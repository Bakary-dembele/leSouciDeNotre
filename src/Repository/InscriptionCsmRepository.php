<?php

namespace App\Repository;

use App\Entity\InscriptionCsm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InscriptionCsm|null find($id, $lockMode = null, $lockVersion = null)
 * @method InscriptionCsm|null findOneBy(array $criteria, array $orderBy = null)
 * @method InscriptionCsm[]    findAll()
 * @method InscriptionCsm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InscriptionCsmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InscriptionCsm::class);
    }

    // /**
    //  * @return InscriptionCollecte[] Returns an array of InscriptionCollecte objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InscriptionCollecte
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
