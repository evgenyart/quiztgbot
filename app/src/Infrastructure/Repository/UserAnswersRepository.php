<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Repository\UserAnswersRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Domain\Entity\UserAnswers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DBAL\Connection;

class UserAnswersRepository extends ServiceEntityRepository implements UserAnswersRepositoryInterface
{
    public function __construct(ManagerRegistry $registry, private Connection $db)
    {
        parent::__construct($registry, UserAnswers::class);
    }

    public function findByIds(iterable $ids): iterable
    {
        return [];
    }

    public function save(UserAnswers $userAnswers): void
    {
        $this->getEntityManager()->persist($userAnswers);
        $this->getEntityManager()->flush();
        #$id = $userAnswers->getId();
    }

    public function findByGameId(int $gameId): iterable
    {
        return $this->findBy(['game_id' => $gameId]);
    }

    public function getAll(): iterable
    {
        return [];
    }

    public function getCountBySession(int $sessionId): int
    {
        $query = $this->getEntityManager()->createQuery(
            'SELECT COUNT(ua.id)
             FROM App\Domain\Entity\UserAnswers ua
             WHERE ua.sessionId = :sessionId'
        )->setParameter('sessionId', $sessionId);

        return $query->getSingleScalarResult();
    }
}