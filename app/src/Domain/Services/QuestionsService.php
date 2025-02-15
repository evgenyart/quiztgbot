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
        return null;
    }

    public function getQuestionsByGameId(int $gameId)
    {
        return $this->questionsRepository->findByGameId($gameId);
    }

    public function getQuestionById(int $id): ?Questions
    {
        return $this->questionsRepository->findQuestionById($id);
    }

    public function addtQuestion(Questions $question): void
    {
        $this->questionsRepository->save($question);
    }

    public function getCountQuestions($gameId): int
    {
        return $this->questionsRepository->getCountQuestions($gameId);
    }

    public function showNextQuestion($gameId, $userSessionId, $showedIds)
    {
        return $this->questionsRepository->getNextQuestion($gameId, $userSessionId, $showedIds);
    }
}