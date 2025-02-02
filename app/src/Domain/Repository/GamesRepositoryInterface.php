<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Games;

interface GamesRepositoryInterface
{
    public function save(Games $games): void;

    public function findByIds(iterable $ids): iterable;

    public function findAll(): iterable;

    #public function delete(int $id): void;
}