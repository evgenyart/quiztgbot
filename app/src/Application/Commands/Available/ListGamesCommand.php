<?php

declare(strict_types=1);

namespace App\Application\Commands\Available;

use App\Application\Commands\CommandInterface;
use App\Application\UseCase\Games\GetGamesListUseCase;
use Psr\Log\LoggerInterface;
use App\Application\Helpers\MessagesHelpers;

class ListGamesCommand implements CommandInterface
{
    private $gamesListUseCase;

    public function __construct(
        private LoggerInterface $logger,
        GetGamesListUseCase $gamesListUseCase,
        
    )
    {
        $this->logger = $logger;
        $this->gamesListUseCase = $gamesListUseCase;
    }

    public function execute(string $message = ""): ?string
    {
        $games = $this->gamesListUseCase->__invoke();
        $response = MessagesHelpers::formatGamesList($games);
        
        return $response;
    }
}