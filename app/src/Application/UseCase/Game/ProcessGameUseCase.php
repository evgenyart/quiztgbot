<?php

declare(strict_types=1);

namespace App\Application\UseCase\Game;

use App\Domain\Services\QuestionsService;
use App\Domain\Services\GamesService;
use App\Domain\Services\UserAnswersService;

class ProcessGameUseCase
{
    private $questionsService;
    private $gamesService;
    private $userAnswersService;

    public function __construct(
        QuestionsService $questionsService, 
        GamesService $gamesService,
        UserAnswersService $userAnswersService
    ) {
        $this->questionsService = $questionsService;
        $this->gamesService = $gamesService;
        $this->userAnswersService = $userAnswersService;
    }

    public function __invoke(int $gameId, int $userId): string
    {
        $response = "";
        $game = $this->gamesService->getGameById($gameId);
        if($game) {
            #$userAnswers = $this->userAnswersService->getUserAnswerByFilter(['user_id' => $userId, 'game_id' => $gameId]);
            
        } else {
            $response = "Игра с введеным ID не найдена";
        }
        #$questions = $this->questionsService->findQuestionByGameIdNumQuestion($gameId);


        return $response;
    }
}