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
    )
    {
    }

    public function showNextStep($userId)
    {
        #получим внутренний id пользователя
        $internalUserId = $this->userHelper->getInternalUserId($userId);

        #проверим, есть ли открытая сессия у пользователя и какой последний вопрос был задан
        $sessionInfo = $this->sessionHelper->getActiveSessionLastQuestionId($internalUserId);

        if($sessionInfo){
            #проверим сколько вопросов в базе
            $cntQuestions = $this->questionsService->getCountQuestions($sessionInfo['gameId']);

            #определим, сколько вопросов уже прошёл пользователь
            $idsQuestionsAnswers = $this->userAnswersService->getIdsQuestionsAnswersBySession($sessionInfo['id']);

            if($cntQuestions > count($idsQuestionsAnswers)) {
                #вывести следующий вопрос, поставить флаг, что вопрос выведен
                $response = $this->questionHelper->ShowQuestion($sessionInfo['gameId'], $sessionInfo['id'], $idsQuestionsAnswers);
            } else {
                #вывести результат, закрыть сессию
                $response = $this->calculateResult($sessionInfo['id'], $cntQuestions);
                $this->sessionHelper->closeSession($sessionInfo['id']);
            }

            return $response;
        }
    }

    public function calculateResult($sessionId, $cntQuestions)
    {
        $cntRight = $this->userAnswersService->getCountRightAnswersBySession($sessionId);

        $response = "\xE2\x9C\xA8 Игра окончена! \n\n";
        $response .= "правильных ответов ".$cntRight. " из ".$cntQuestions;

        return $response;
    }
}
