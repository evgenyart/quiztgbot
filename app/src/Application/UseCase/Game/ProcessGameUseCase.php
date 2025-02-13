<?php

declare(strict_types=1);

namespace App\Application\UseCase\Game;

use App\Application\Helpers\UserHelper;
use App\Application\Helpers\SessionHelper;
use App\Domain\Entity\Sessions;
use App\Domain\Services\QuestionsService;
use App\Domain\Services\GamesService;
use App\Domain\Services\UserAnswersService;
use App\Domain\Services\UsersService;
use App\Domain\Services\SessionsService;
use App\Domain\Entity\Users;
use App\Application\Helpers\QuestionHelper;

class ProcessGameUseCase
{
    public function __construct(
        private QuestionsService $questionsService,
        private GamesService $gamesService,
        private UserAnswersService $userAnswersService,
        private UsersService $usersService,
        private SessionsService $sessionsService,
        private QuestionHelper $questionHelper,
        private SessionHelper $sessionHelper,
        private UserHelper $userHelper
        
    ) {
    }

    public function __invoke(int $gameId, int $userId): string
    {
        $response = "";
        $game = $this->gamesService->getGameById($gameId);
        if($game) {
            #проверить, есть ли пользователь в базе. если есть - вернуть внутренний id. если нет - создать
            $internalUserId = $this->userHelper->getInternalUserId($userId);

            #проверить,если ли в базе вопросы по выбранному квизу
            if ($this->checkIssetQuestions($gameId)) {
                #проверить, проходил ли данный пользователь уже такой квиз

                #определим сессию пользователя
                $userSessionId = $this->sessionHelper->getSessionsGameByUser($internalUserId, $gameId);

                #если есть другие сесси пользователя, то закроем их всех
                $this->sessionHelper->closeSessionsExcept($internalUserId, $userSessionId);

                #определим, сколько вопросов есть в базе
                $cntQuestions = $this->questionsService->getCountQuestions($gameId);

                #определим, сколько вопросов уже прошёл пользователь
                $cntAnswersSession = $this->userAnswersService->getCountAnswersBySession($userSessionId);

                #если это новая игра, то выдадим вопрос
                if ($cntAnswersSession == 0) {
                    return $this->questionHelper->ShowQuestion($gameId, $userSessionId, []);
                }

                #$response = "В базе ".$cntQuestions." вопросов \n";
                #$response .= "Пользователь ответил на ".$cntAnswersSession;


            } else {
                $response = "Для выбранной игры нет вопросов в базе. Выберите другую игру";
            }
        } else {
            $response = "Игра с введеным ID не найдена";
        }
        #$questions = $this->questionsService->findQuestionByGameIdNumQuestion($gameId);


        return $response;
    }

    #вынести в отдельный класс
    private function checkIssetQuestions($gameId)
    {
        return $this->gamesService->checkIssetQuestions($gameId);
    }

}