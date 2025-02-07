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

    public function getAll(): iterable
    {
        return [];
    }
}