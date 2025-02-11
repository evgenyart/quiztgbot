<?php

declare(strict_types=1);

namespace App\Application\Commands;

use Psr\Log\LoggerInterface;
use App\Application\Commands\Available\ListGamesCommand;
use App\Application\Commands\Available\StartGameCommand;


class CommandHandler
{
    private $listGamesCommand;

    public function __construct(
        ListGamesCommand $listGamesCommand,
        StartGameCommand $startGameCommand,
        private LoggerInterface $logger
    ) {
        $this->listGamesCommand = $listGamesCommand;
        $this->logger = $logger;
        $this->startGameCommand = $startGameCommand;
    }

    public function handle(string $commandName, string $message, int $userID = 0): ?string {
        
        $response = "";

        #узко
        $this->logger->warning($commandName);
        switch ($commandName) {
            case '/list':
                $response = $this->listGamesCommand->execute();
                break;
            case '/start':
                $response = $this->startGameCommand->execute($message, $userID);
                break;
        }

        return $response;
        
    }
}