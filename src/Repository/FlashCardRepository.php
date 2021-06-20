<?php

namespace App\Repository;

use App\Entity\FlashCard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FlashCard|null find($id, $lockMode = null, $lockVersion = null)
 * @method FlashCard|null findOneBy(array $criteria, array $orderBy = null)
 * @method FlashCard[]    findAll()
 * @method FlashCard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FlashCardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FlashCard::class);
    }

    // /**
    //  * @return FlashCard[] Returns an array of FlashCard objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FlashCard
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
