<?php

declare(strict_types=1);

namespace App\Application\Commands\Available;

use App\Application\Commands\CommandInterface;
use App\Application\UseCase\Games\GetGamesListUseCase;
use App\Application\Helpers\TelegramHelper;

class ListGamesCommand implements CommandInterface
{
    public function __construct(private GetGamesListUseCase $gamesListUseCase)
    {
    }

    public function execute(string $message = "", int $userId = 0): string
    {
        $games = $this->gamesListUseCase->__invoke();
        return TelegramHelper::formatGamesList($games);
    }
}
