<?php

declare(strict_types=1);

namespace App\Application\Commands;

use Psr\Log\LoggerInterface;
use App\Application\Commands\Available\ListGamesCommand;


class CommandHandler
{
    private $listGamesCommand;

    public function __construct(
        ListGamesCommand $listGamesCommand,
        private LoggerInterface $logger
    ) {
        $this->listGamesCommand = $listGamesCommand;
        $this->logger = $logger;
    }

    public function handle($commandName, $message): ?string {
        
        $response = "";

        #узко
        $this->logger->warning($commandName);
        switch ($commandName) {
            case '/list':
                $response = $this->listGamesCommand->execute();
                break;
        }

        return $response;
        
    }
}