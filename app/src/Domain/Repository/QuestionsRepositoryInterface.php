<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Questions;

interface QuestionsRepositoryInterface
{
    public function save(Questions $questions): void;

    public function findByIds(iterable $ids): iterable;

    public function findQuestionById(int $id): ?Questions;

    public function getAll(): iterable;

    public function findByGameId(int $gameId);

    public function getCountQuestions(int $gameId): int;

    public function getNextQuestion($gameId, $userSessionId, $showedIds): ?Questions;

    #public function delete(int $id): void;
}