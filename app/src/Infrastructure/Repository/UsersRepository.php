<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Repository\UsersRepositoryInterface;
use App\Domain\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;

class UsersRepository extends ServiceEntityRepository implements UsersRepositoryInterface
{
    public function __construct(ManagerRegistry $registry, private Connection $db)
    {
        parent::__construct($registry, Users::class);
    }

    public function findByExternalId(int $externalId): ?Users
    {
        return $this->findOneBy(['tgId' => $externalId]);
    }

    public function save(Users $user): void
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }
}