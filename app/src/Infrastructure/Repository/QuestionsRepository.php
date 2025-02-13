<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Repository\QuestionsRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Domain\Entity\Questions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DBAL\Connection;

class QuestionsRepository extends ServiceEntityRepository implements QuestionsRepositoryInterface
{
    public function __construct(ManagerRegistry $registry, private Connection $db)
    {
        parent::__construct($registry, Questions::class);
    }

    public function findByIds(iterable $ids): iterable
    {
        return [];
    }

    public function save(Questions $questions): void
    {
        $this->getEntityManager()->persist($questions);
        $this->getEntityManager()->flush();
        #$id = $questions->getId();
    }

    public function getCountQuestions(int $gameId):int
    {
        $query = $this->getEntityManager()->createQuery(
            'SELECT COUNT(q.id)
             FROM App\Domain\Entity\Questions q
             JOIN App\Domain\Entity\Tours t WITH q.tourId = t.id
             WHERE t.gameId = :gameId'
        )->setParameter('gameId', $gameId);

        return $query->getSingleScalarResult();
    }

    public function getNextQuestion($gameId, $userSessionId, $cntAnswersSession): ?Questions
    {
        $query = $this->getEntityManager()->createQuery(
            'SELECT q
             FROM App\Domain\Entity\Questions q
             JOIN App\Domain\Entity\Tours t WITH q.tourId = t.id
             WHERE t.gameId = :gameId
             ORDER BY q.tourId ASC, q.questionNum ASC'
        )->setParameter('gameId', $gameId)->setMaxResults(1);

        return $query->getOneOrNullResult();
    }

    public function findQuestionById(int $id): ?Questions
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function findByGameId(int $gameId)
    {
        return $this->findBy(['gameId' => $gameId]);
    }

    public function getAll(): iterable
    {
        return [];
    }
}