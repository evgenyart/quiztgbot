<?php

declare(strict_types=1);

namespace App\Application\Telegram;

use App\Application\Helpers\QuestionHelper;
use App\Application\Helpers\SessionHelper;
use App\Domain\Entity\UserAnswers;
use App\Domain\Services\UserAnswersService;
use App\Domain\Services\UsersService;
use App\Application\Helpers\UserHelper;

class MessageHandler
{
    public function __construct(
        private UsersService $usersService,
        private UserHelper $userHelper,
        private SessionHelper $sessionHelper,
        private QuestionHelper $questionHelper,
        private UserAnswersService $userAnswersService
    )
    {
    }

    public function processMessage(int $userId, string $message)
    {
        #получим внутренний id пользователя
        $internalUserId = $this->userHelper->getInternalUserId($userId);

        #проверим, есть ли открытая сессия у пользователя и какой последний вопрос был задан
        $sessionInfo = $this->sessionHelper->getActiveSessionLastQuestionId($internalUserId);

        #если вопрос есть в открытой сессии, то, подтянем вопрос, проверим ответ и выдадим следующий вопрос
        if ($sessionInfo) {
            $questionData = $this->questionHelper->requestQuestionById($sessionInfo['lastQuestionId']);

            if($questionData) {
                #проверим ответ
                $resultAnswer = $this->checkAnswer($questionData->getAnswer(), $message);

                #запишем ответ пользователя в таблицу и результат
                $userAnswer = new UserAnswers(
                    $internalUserId,
                    $sessionInfo['id'],
                    $sessionInfo['lastQuestionId'],
                    $message,
                    $resultAnswer
                );
                $this->userAnswersService->addUserAnswer($userAnswer);

                #выведем результат пользователю
                return $this->showResultCheck($resultAnswer);
            }
        } else {
            return "Нет активных игр у пользователя. Для справки введите /help";
        }
    }

    private function showResultCheck($resultAnswer): string
    {
        $result = "";
        if($resultAnswer) {
            $result = "\xE2\x9C\x85 Верно!";
        } else {
            $result = "\xE2\x9D\x8C Не верно!";
        }

        return $result;
    }

    private function checkAnswer($goodAnswer, $userAnswer):bool
    {
        $result = false;
        $goodAnswer = trim($goodAnswer);
        $userAnswer = mb_strtolower($userAnswer);
        $userAnswer = str_replace(' ', '', $userAnswer);

        $arAnswer = explode("#", $goodAnswer);
        foreach($arAnswer as $answer) {
            $answer = str_replace(' ', '', $answer);
            if(mb_strtolower($answer) == $userAnswer){
                $result = true;
                break;
            }
        }

        return $result;
    }
}