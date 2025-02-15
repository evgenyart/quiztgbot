<?php

declare(strict_types=1);

namespace App\Application\Helpers;

use App\Application\Helpers\QuestionHelper;
use App\Application\Helpers\UserHelper;
use App\Application\Helpers\SessionHelper;
use App\Domain\Services\QuestionsService;
use App\Domain\Services\UserAnswersService;

class ProcessHelper
{
    public function __construct(
        private UserHelper $userHelper,
        private SessionHelper $sessionHelper,
        private QuestionsService $questionsService,
        private UserAnswersService $userAnswersService,
        private QuestionHelper $questionHelper
    ) {
    }

    public function showNextStep($userId): ?string
    {
        #получим внутренний id пользователя
        $internalUserId = $this->userHelper->getInternalUserId($userId);

        #проверим, есть ли открытая сессия у пользователя и какой последний вопрос был задан
        $sessionInfo = $this->sessionHelper->getActiveSessionLastQuestionId($internalUserId);

        if (!$sessionInfo) {
            return null;
        }

        #проверим сколько вопросов в базе
        $cntQuestions = $this->questionsService->getCountQuestions($sessionInfo['gameId']);

        #определим, id вопросов уже прошёл пользователь
        $idsQuestionsAnswers = $this->userAnswersService->getIdsQuestionsAnswersBySession($sessionInfo['id']);

        if ($cntQuestions > count($idsQuestionsAnswers)) {
            #вывести следующий вопрос, поставить флаг, что вопрос выведен
            return $this->showNextQuestion($sessionInfo, $idsQuestionsAnswers);
        } else {
            #вывести результат, закрыть сессию
            return $this->finishSession($sessionInfo, $cntQuestions);
        }
    }

    private function showNextQuestion($sessionInfo, $idsQuestionsAnswers): string
    {
        return $this->questionHelper->showQuestion(
            $sessionInfo['gameId'],
            $sessionInfo['id'],
            $idsQuestionsAnswers
        );
    }

    private function finishSession($sessionInfo, $cntQuestions): string
    {
        $response = $this->calculateResult($sessionInfo['id'], $cntQuestions);
        $this->sessionHelper->closeSession($sessionInfo['id']);
        return $response;
    }

    private function calculateResult($sessionId, $cntQuestions): string
    {
        $cntRight = $this->userAnswersService->getCountRightAnswersBySession($sessionId);

        $response = "\xE2\x9C\xA8 Игра окончена! \n\n";
        $response .= "правильных ответов " . $cntRight . " из " . $cntQuestions;

        return $response;
    }
}
