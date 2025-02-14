<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Repository\GamesRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Domain\Entity\Games;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DBAL\Connection;

class GamesRepository extends ServiceEntityRepository implements GamesRepositoryInterface
{
    public function __construct(ManagerRegistry $registry, private Connection $db)
    {
        parent::__construct($registry, Games::class);
    }

    public function findByIds(iterable $ids): iterable
    {
        #temp hack
        $id = $ids[0];
        return $this->getEntityManager()->getRepository(Quiz::class)->find($id);
    }

    public function save(Games $games): void
    {
        $this->getEntityManager()->persist($games);
        $this->getEntityManager()->flush();
        #$id = $games->getId();
    }

    public function getAll(): iterable
    {
        return $this->getEntityManager()->getRepository(Games::class)->findAll();
    }

    public function hasQuestions($gameId): bool
    {
        $query = $this->getEntityManager()->createQuery(
            'SELECT COUNT(q.id)
             FROM App\Domain\Entity\Questions q
             JOIN App\Domain\Entity\Tours t WITH q.tourId = t.id
             WHERE t.gameId = :gameId'
        )->setParameter('gameId', $gameId);

        return $query->getSingleScalarResult() > 0;
    }
}
