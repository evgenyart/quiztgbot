<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\TgLogs;

interface TgLogsRepositoryInterface
{
    public function save(TgLogs $tgLogs): void;

    #public function findByIds(iterable $ids): iterable;

    #public function getAll(): iterable;

    #public function delete(int $id): void;
}