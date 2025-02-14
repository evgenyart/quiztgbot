<?php

declare(strict_types=1);

namespace App\Application\UseCase\Games;

use App\Application\UseCase\Games\GetGamesListResponse;
use App\Domain\Services\GamesService;

class GetGamesListUseCase
{
    private $gamesService;

    public function __construct(GamesService $gamesService)
    {
        $this->gamesService = $gamesService;
    }

    public function __invoke(): GetGamesListResponse
    {
        $result = [];

        $gamesList = $this->gamesService->getAllGames();

        foreach ($gamesList as $oneGame) {
            $result[] = [
                'id' => $oneGame->getId(),
                'name' => $oneGame->getName(),
                'num_tours' => $oneGame->getNumTours(),
                'num_questions' => $oneGame->getNumQuestions(),
                'created_at' => $oneGame->getCreatedAt(),
                'updated_at' => $oneGame->getUpdatedAt()
            ];
        }

        return new GetGamesListResponse($result);
    }
}
