<?php

namespace App\Repository;

use App\Entity\Session;
use App\Entity\FlashCard;
use App\Entity\Group;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Session|null find($id, $lockMode = null, $lockVersion = null)
 * @method Session|null findOneBy(array $criteria, array $orderBy = null)
 * @method Session[]    findAll()
 * @method Session[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Session::class);
    }

    // /**
    //  * @return Session[] Returns an array of Session objects
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

    public function findById($id): ?Session
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.id = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getMaxFlasCardIdForGroup($groupId): ?int
    {
        $entityManager = $this->getEntityManager()->createQueryBuilder();
        $result = $entityManager
            ->select('f.id')
            ->from('App:FlashCard', 'f')
            ->where('f.GroupId = :groupId')
            ->orderBy('f.id', 'DESC')
            ->setMaxResults(1)
            ->setParameter('groupId', $groupId)
            ->getQuery()
            ->getResult();

        return $result[0]['id'];
    }

    public function getRandomFlashCardId(Group $group): ?int
    {
        $groupId = $group->getId();

        $entityManager = $this->getEntityManager()->createQueryBuilder();
        $result = $entityManager
            ->select(array('f.id'))
            ->from('App:FlashCard', 'f')
            ->where('f.GroupId = :groupId')
            ->setParameter('groupId', $groupId)
            ->getQuery()
            ->getResult();

        $flashcardIds = array();

        for ($i = 0; $i < count($result); $i++) {
            array_push($flashcardIds, $result[$i]['id']);
        }
        return $flashcardIds[array_rand($flashcardIds)];
    }


    public function addCorrect($id, $value): void
    {
        $this->createQueryBuilder('s')
            ->update('session', 's')
            ->set('s.correctCount', ':value')
            ->where('s.id = :id')
            ->setParameter('value', $value)
            ->setParameter('id', $id)
            ->getQuery()
            ->execute();
    }

    public function addIncorrect($id, $value): void
    {
        $this->createQueryBuilder('s')
            ->update('session', 's')
            ->set('s.incorrectCount', ':value')
            ->where('s.id = :id')
            ->setParameter('value', $value)
            ->setParameter('id', $id)
            ->getQuery()
            ->execute();
    }
}
