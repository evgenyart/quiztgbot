<?php

declare(strict_types=1);

namespace App\Application\UseCase\Game\Handlers;

use App\Application\UseCase\Game\Handlers\AbstractGameHandler;
use App\Domain\Services\GamesService;

class GameExistsHandler extends AbstractGameHandler
{
    public function __construct(private GamesService $gamesService)
    {
    }

    public function handle(int $gameId, int $userId, int $userSessionId = 0): ?string
    {
        $game = $this->gamesService->getGameById($gameId);
        if (!$game) {
            return "Игра с введеным ID не найдена";
        }

        return parent::handle($gameId, $userId, $userSessionId);
    }
}
