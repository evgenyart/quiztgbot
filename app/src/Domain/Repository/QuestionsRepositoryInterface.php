<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Questions;

interface QuestionsRepositoryInterface
{
    public function save(Questions $questions): void;

    public function findByIds(iterable $ids): iterable;

    public function getAll(): iterable;

    public function findByGameId(int $gameId): iterable;

    #public function delete(int $id): void;
}