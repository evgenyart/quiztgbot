<?php

declare(strict_types=1);

namespace App\Application\UseCase\Games;

use App\Application\UseCase\Games\CreateGameRequest;
use App\Application\UseCase\Games\CreateGameResponse;
use App\Domain\Repository\GamesRepositoryInterface;
use App\Domain\Factory\GamesFactoryInterface;

class CreateGameUseCase
{
    public function __construct(
        private readonly GamesFactoryInterface $gameFactory,
        private readonly GamesRepositoryInterface $gameRepository
    ) {
    }

    public function __invoke(CreateGameRequest $request): CreateGameResponse
    {
        $game = $this->gameFactory->create($request->name, $request->numTours, $request->numQuestions);

        $this->gameRepository->save($game);

        return new CreateGameResponse(
            $game->getId()
        );
    }
}
