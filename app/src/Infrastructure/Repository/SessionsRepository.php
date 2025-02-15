<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Repository\SessionRepositoryInterface;
use App\Domain\Entity\Sessions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DBAL\Connection;

class SessionsRepository extends ServiceEntityRepository implements SessionRepositoryInterface
{
    public function __construct(ManagerRegistry $registry, private Connection $db)
    {
        parent::__construct($registry, Sessions::class);
    }

    public function save(Sessions $session): void
    {
        $this->getEntityManager()->persist($session);
        $this->getEntityManager()->flush();
    }

    public function findByUserAndGame($userId, $gameId): ?Sessions
    {
        return $this->findOneBy(['userId' => $userId, 'gameId' => $gameId, 'startedAt' => null]);
    }

    public function closeSession($sessionId)
    {
        $userSession = $this->find($sessionId);
        $userSession->setFinishedAt(new \DateTime());
        $this->getEntityManager()->flush();
    }

    public function closeSessionsExcept($internalUserId, $sessionId)
    {
        $sql = 'UPDATE App\Domain\Entity\Sessions s
         SET s.finishedAt = :now
         WHERE s.userId = :internalUserId
         AND s.finishedAt IS NULL';

        if ($sessionId <> null) {
            $sql .= ' AND s.id != :sessionId ';
        }


        $query = $this->getEntityManager()->createQuery($sql)
            ->setParameter('internalUserId', $internalUserId)
            ->setParameter('now', new \DateTime());

        if ($sessionId <> null) {
            $query->setParameter('sessionId', $sessionId);
        }

        $query->execute();
    }

    public function updateQuestionId($userSessionId, $questionId): void
    {
        $userSession = $this->find($userSessionId);
        $userSession->setLastQuestionId($questionId);
        $this->getEntityManager()->flush();
    }

    public function findByUserActiveSession($internalUserId)
    {
        $query = $this->getEntityManager()->createQuery(
            'SELECT s.id, s.lastQuestionId, s.gameId
             FROM App\Domain\Entity\Sessions s
             WHERE s.userId = :internalUserId
             AND s.startedAt IS NOT NULL
             AND s.finishedAt IS NULL'
        )->setParameter('internalUserId', $internalUserId)
            ->setMaxResults(1);

        $result = $query->getOneOrNullResult();

        return $result ? [
            'id' => $result['id'],
            'lastQuestionId' => $result['lastQuestionId'],
            'gameId' => $result['gameId']
        ] : null;
    }
}
