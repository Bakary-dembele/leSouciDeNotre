<?php

namespace App\Repository;

use App\Entity\InscriptionEvenementFoot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method InscriptionEvenementFoot|null find($id, $lockMode = null, $lockVersion = null)
 * @method InscriptionEvenementFoot|null findOneBy(array $criteria, array $orderBy = null)
 * @method InscriptionEvenementFoot[]    findAll()
 * @method InscriptionEvenementFoot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InscriptionEvenementFootRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InscriptionEvenementFoot::class);
    }



    // /**
    //  * @return InscriptionEvenementFoot[] Returns an array of InscriptionEvenementFoot objects
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
    public function findOneBySomeField($value): ?InscriptionEvenementFoot
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
