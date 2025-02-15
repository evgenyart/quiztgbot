<?php

declare(strict_types=1);

namespace App\Application\Commands;

use App\Application\Commands\CommandInterface;
use App\Application\Commands\Available\ListGamesCommand;
use App\Application\Commands\Available\StartGameCommand;
use App\Application\Commands\Available\HelpCommand;
use App\Application\Commands\Available\StopGamesCommand;
use App\Application\Commands\Available\UnknownCommand;
use App\Application\UseCase\Games\GetGamesListUseCase;
use App\Application\UseCase\Game\StopGameUseCase;
use App\Application\UseCase\Game\ProcessGameUseCase;

class CommandFactory
{
    public function __construct(
        private ListGamesCommand $listGamesCommand,
        private StartGameCommand $startGameCommand,
        private HelpCommand $helpCommand,
        private StopGamesCommand $stopGamesCommand,
        private UnknownCommand $unknownCommand,
        private GetGamesListUseCase $gamesListUseCase,
        private StopGameUseCase $stopGameUseCase,
        private ProcessGameUseCase $processGameUseCase
    ) {
    }

    public function createCommand(string $commandName): CommandInterface
    {
        switch ($commandName) {
            case '/list':
                return new ListGamesCommand($this->gamesListUseCase);
            case '/start':
                return new StartGameCommand($this->processGameUseCase);
            case '/help':
                return new HelpCommand();
            case '/stop':
                return new StopGamesCommand($this->stopGameUseCase);
            default:
                return new UnknownCommand();
        }
    }
}
