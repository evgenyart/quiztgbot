<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Repository\ToursRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Domain\Entity\Tours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DBAL\Connection;

class ToursRepository extends ServiceEntityRepository implements ToursRepositoryInterface
{
    public function __construct(ManagerRegistry $registry, private Connection $db)
    {
        parent::__construct($registry, Tours::class);
    }

    public function findByIds(iterable $ids): iterable
    {
        return [];
    }

    public function save(Tours $tours): void
    {
        $this->getEntityManager()->persist($tours);
        $this->getEntityManager()->flush();
        #$id = $tours->getId();
    }

    public function getAll(): iterable
    {
        return [];
    }
}