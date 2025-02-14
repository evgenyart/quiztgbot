<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Tours;

interface ToursRepositoryInterface
{
    public function save(Tours $tours): void;

    public function findByIds(iterable $ids): iterable;

    public function getAll(): iterable;

    #public function delete(int $id): void;
}
