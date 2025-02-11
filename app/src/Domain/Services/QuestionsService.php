<?php

declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Entity\Questions;
use App\Domain\Repository\QuestionsRepositoryInterface;

class QuestionsService
{
    private QuestionsRepositoryInterface $questionsRepository;

    public function __construct(QuestionsRepositoryInterface $questionsRepository)
    {
        $this->questionsRepository = $questionsRepository;
    }

    public function findQuestionByGameIdNumQuestion(int $gameId, int $questionNum = 1): ?Questions
    {

    }

    public function getQuestionById(int $id): ?Games
    {
        return $this->questionsRepository->findById($id);
    }

    public function addtQuestion(Questions $question): void
    {
        $this->questionsRepository->save($question);
    }
}