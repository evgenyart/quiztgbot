<?php

declare(strict_types=1);

namespace App\Application\UseCase\Games;

use App\Domain\Repository\GamesRepositoryInterface;

class GetGamesListUseCase
{
    public function __construct(
        private readonly GamesRepositoryInterface $gamesRepository
    ) {
    }

    public function __invoke(): GeGamesListResponse
    {
        $result = [];

        $gamesList = $this->gamesRepository->findAll();

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

        return new GeGamesListResponse($result);
    }
}