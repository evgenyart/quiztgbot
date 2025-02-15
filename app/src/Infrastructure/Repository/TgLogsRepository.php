<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Repository\TgLogsRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Domain\Entity\TgLogs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\DBAL\Connection;

class TgLogsRepository extends ServiceEntityRepository implements TgLogsRepositoryInterface
{
    public function __construct(ManagerRegistry $registry, private Connection $db)
    {
        parent::__construct($registry, TgLogs::class);
    }
    public function save(TgLogs $tgLogs): void
    {
        $this->getEntityManager()->persist($tgLogs);
        $this->getEntityManager()->flush();
        #$id = $tgLogs->getId();
    }
}
