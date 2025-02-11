<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\UserAnswers;

interface UserAnswersRepositoryInterface
{
    public function save(UserAnswers $userAnswers): void;

    public function findByGameId(int $gameId): iterable;

    #public function findByFilter(iterable $filter): iterable;

    #public function findByIds(iterable $ids): iterable;

    #public function getAll(): iterable;

    #public function delete(int $id): void;
}