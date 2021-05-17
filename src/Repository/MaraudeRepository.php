<?php

namespace App\Repository;

use App\Entity\Maraude;
use App\Entity\MaraudeSearchData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method Maraude|null find($id, $lockMode = null, $lockVersion = null)
 * @method Maraude|null findOneBy(array $criteria, array $orderBy = null)
 * @method Maraude[]    findAll()
 * @method Maraude[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaraudeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Maraude::class);
    }

    public function findMaraudes(MaraudeSearchData $searchData, UserInterface $user)
    {

        $qb = $this
            ->createQueryBuilder('s')
            ->innerJoin('s.etat', 'e')
            ->innerJoin('s.organisateur', 'u')
            ->innerJoin('s.groupe','g')
            ->innerJoin('s.lieu', 'l')
            ->innerJoin('l.ville', 'v')
            ->leftJoin('s.inscriptions', 'i')
            ->leftJoin('i.user', 'u2')
            ->addSelect('i')
            ->addSelect('u2')
        ;

        if(!empty($searchData->getMotCle())){
            $qb = $qb
                ->andWhere('s.nom LIKE :motCle')
                ->setParameter('motCle', "%{$searchData->getMotCle()}%")
            ;
        }

        if(!empty($searchData->getNomGroupe())){
            $qb = $qb
                ->andWhere('g.id = :nomGroupe')
                ->setParameter('nomGroupe', $searchData->getNomGroupe())
            ;
        }

        if (!empty($searchData->getDateDebutSearch() && !empty($searchData->getDateFinSearch()))){
            $qb = $qb
                ->andWhere('s.dateDebut BETWEEN :dateDebut AND :dateFin')
                ->setParameter('dateDebut', $searchData->getDateDebutSearch())
                ->setParameter('dateFin', $searchData->getDateFinSearch())
            ;
        }

        if(!empty($searchData->isMaraudeOrganisateur()) && $searchData->isMaraudeOrganisateur() === true){

            $qb = $qb
                ->andWhere('u.id =  :organisateur')
                ->setParameter('organisateur', $user)
            ;
        }

        if(!empty($searchData->isMaraudeInscrit()) && $searchData->isMaraudeInscrit() === true){

            $qb = $qb
                ->andWhere('i.user =  :inscrit')
                ->setParameter('inscrit', $user)
            ;
        }

        if(!empty($searchData->isMaraudeNonInscrit()) && $searchData->isMaraudeNonInscrit() === true){

            $qb = $qb
                ->andWhere('NOT i.user =  :nonInscrit')
                ->setParameter('nonInscrit', $user)
            ;
        }

        if(!empty($searchData->isMaraudePassees()) && $searchData->isMaraudePassees() === true){
            $dateDuJour = new \DateTime();
            $qb = $qb
                ->andWhere('s.dateCloture <  :dateDujour')
                ->setParameter('dateDujour', $dateDuJour)
            ;
        }

        if(!empty($searchData->isMaraudePassees()) && !empty($searchData->isMaraudeNonInscrit())
            && !empty($searchData->isMaraudeOrganisateur()) && !empty($searchData->isMaraudeInscrit())){

            $qb = $this
                ->createQueryBuilder('s')
                ->innerJoin('s.etat', 'e')
                ->innerJoin('s.organisateur', 'u')
                ->innerJoin('s.groupe','g')
                ->innerJoin('s.lieu', 'l')
                ->innerJoin('l.ville', 'v')
                ->leftJoin('s.inscriptions', 'i')
                ->leftJoin('i.user', 'u2')
                ->addSelect('i')
                ->addSelect('u2')
            ;

        }


        $query = $qb->getQuery();

        return new Paginator($query) ;
    }

    // /**
    //  * @return Sortie[] Returns an array of Sortie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sortie
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
