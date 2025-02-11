<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Repository\UsersRepositoryInterface;
use App\Domain\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;

class UsersRepository implements UsersRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findByExternalId(int $externalId): ?Users
    {
        return $this->entityManager->getRepository(Users::class)->findBy(['tg_id' => $externalId]);
    }

    public function save(Users $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}