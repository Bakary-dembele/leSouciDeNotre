<?php

namespace App\Repository;

use App\Entity\Csm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method Csm|null find($id, $lockMode = null, $lockVersion = null)
 * @method Csm|null findOneBy(array $criteria, array $orderBy = null)
 * @method Csm[]    findAll()
 * @method Csm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CsmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Csm::class);
    }

    public function findPoleJeunesse(UserInterface $user)
    {
        $qb = $this
            ->createQueryBuilder('s')
            ->innerJoin('s.referent', 'u')
            ->innerJoin('s.inscriptionPoleVisites', 'i')
            ->innerJoin('i.user', 'u2')
            ->addSelect('i')
            ->addSelect('u');
    }

    // /**
    //  * @return Collecte[] Returns an array of Collecte objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Collecte
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
