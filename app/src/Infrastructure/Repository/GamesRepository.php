<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Repository\GamesRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Domain\Entity\Games;

class GamesRepository implements GamesRepositoryInterface
{
    public function findByIds(iterable $ids): iterable
    {
        return [];
    }

    public function save(Games $games): void
    {

    }

    public function findAll(): iterable
    {
        return [];
    }
}