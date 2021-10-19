<?php

namespace App\Repository;

use App\Entity\Session;
use App\Entity\FlashCard;
use App\Entity\Group;
use App\DTO\AllSessionStatistics;
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

    public function findById($id): ?Session
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.id = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getAllStatistics(): AllSessionStatistics
    {
        $entityManager = $this->getEntityManager();
        $queryResult = $entityManager->createQueryBuilder()
            ->select('s.correctCount, s.incorrectCount')
            ->from('App:Session', 's')
            ->getQuery()
            ->getResult();

        $result = array('correctCount' => 0, 'incorrectCount' => 0);
        foreach ($queryResult as $row) {
            $result['correctCount'] += $row['correctCount'];
            $result['incorrectCount'] += $row['incorrectCount'];
        }

        $statistics = new AllSessionStatistics(0, 0);
        $statistics->setCorrectCount($result['correctCount']);
        $statistics->setIncorrectCount($result['incorrectCount']);

        return  $statistics;
    }
    
    public function getRandomFlashCardId(Group $group): ?int
    {
        $groupId = $group->getId();

        $entityManager = $this->getEntityManager();
        $result = $entityManager->createQueryBuilder()
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
