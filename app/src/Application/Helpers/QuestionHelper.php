<?php

declare(strict_types=1);

namespace App\Application\Helpers;

use App\Domain\Services\QuestionsService;
use App\Domain\Services\SessionsService;

class QuestionHelper
{
    public function __construct(
        private QuestionsService $questionsService,
        private SessionsService $sessionsService
    ) {
    }

    public function requestQuestionById($lastQuestionId)
    {
        return $this->questionsService->getQuestionById($lastQuestionId);
    }

    public function showQuestion($gameId, $userSessionId, $showedIds): string
    {
        $question = $this->questionsService->showNextQuestion($gameId, $userSessionId, $showedIds);

        if ($question) {
            $this->sessionsService->setLastQuestionId($userSessionId, $question->getId());
            return "\xE2\x9D\x93 Вопрос " . $question->getQuestionNum() . ": " . $question->getText();
        } else {
            return "";
        }
    }
}
