<?php

declare(strict_types=1);

namespace App\Application\UseCase\Game;

use App\Domain\Services\QuestionsService;
use App\Domain\Services\GamesService;
use App\Domain\Services\UserAnswersService;
use App\Domain\Services\UsersService;
use App\Domain\Entity\Users;

class ProcessGameUseCase
{
    private $questionsService;
    private $gamesService;
    private $userAnswersService;
    private $usersService;

    public function __construct(
        QuestionsService $questionsService, 
        GamesService $gamesService,
        UserAnswersService $userAnswersService,
        UsersService $usersService
        
    ) {
        $this->questionsService = $questionsService;
        $this->gamesService = $gamesService;
        $this->userAnswersService = $userAnswersService;
        #$this->usersService = $usersService;
    }

    public function __invoke(int $gameId, int $userId): string
    {
        $response = "";
        $game = $this->gamesService->getGameById($gameId);
        if($game) {
            #проверить, есть ли пользователь в базе. если есть - вернуть внутренний id. если нет - создать
            $internalUserId = $this->getInternalUserId($userId);
            #$userAnswers = $this->userAnswersService->getUserAnswerByFilter(['user_id' => $userId, 'game_id' => $gameId]);
            
        } else {
            $response = "Игра с введеным ID не найдена";
        }
        #$questions = $this->questionsService->findQuestionByGameIdNumQuestion($gameId);


        return $response;
    }

    #вынести в отдельный класс
    private function getInternalUserId(int $userId): int
    {
        $id = 0;

        $user = $this->usersService->getUserById($userId);
        if (!$user) {
            $user = new Users($userId);
            $this->usersService->addUser($user);
        }

        return $user->getId();
    }
}