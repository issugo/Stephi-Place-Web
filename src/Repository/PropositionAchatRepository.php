<?php

namespace App\Repository;

use App\Entity\PropositionAchat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PropositionAchat|null find($id, $lockMode = null, $lockVersion = null)
 * @method PropositionAchat|null findOneBy(array $criteria, array $orderBy = null)
 * @method PropositionAchat[]    findAll()
 * @method PropositionAchat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropositionAchatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PropositionAchat::class);
    }

    // /**
    //  * @return PropositionAchat[] Returns an array of PropositionAchat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PropositionAchat
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
