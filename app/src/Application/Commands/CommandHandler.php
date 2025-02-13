<?php

declare(strict_types=1);

namespace App\Application\Commands;

use App\Application\Commands\Available\HelpCommand;
use App\Application\Commands\Available\StopGamesCommand;
use Psr\Log\LoggerInterface;
use App\Application\Commands\Available\ListGamesCommand;
use App\Application\Commands\Available\StartGameCommand;


class CommandHandler
{
    private $listGamesCommand;

    public function __construct(
        ListGamesCommand $listGamesCommand,
        StartGameCommand $startGameCommand,
        HelpCommand $helpCommand,
        StopGamesCommand $stopGamesCommand,
        private LoggerInterface $logger
    ) {
        $this->listGamesCommand = $listGamesCommand;
        $this->logger = $logger;
        $this->startGameCommand = $startGameCommand;
        $this->helpCommand = $helpCommand;
        $this->stopGamesCommand = $stopGamesCommand;
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
                case '/help':
                    $response = $this->helpCommand->execute();
                    break;
                    case '/stop':
                        $response = $this->stopGamesCommand->execute($message, $userID);
                        break;
                        default:
                            $response = "\xE2\x9D\x97 Команда не найдена. Для просмотра списка доступных команд введите /help";
                            break;
        }

        return $response;
        
    }
}