<?php

declare(strict_types=1);

namespace App\Application\Commands\Available;

use App\Application\Commands\CommandInterface;
use App\Application\UseCase\Games\ProcessGameUseCase;
use Psr\Log\LoggerInterface;
use App\Application\Helpers\MessagesHelpers;

class StartGameCommand implements CommandInterface
{
    private $processGameUseCase;

    public function __construct(
        private LoggerInterface $logger,
        ProcessGameUseCase $processGameUseCase
    )
    {
        $this->logger = $logger;
        $this->processGameUseCase = $processGameUseCase;
    }

    public function execute(string $message = ""): ?string
    {
        $process = $this->processGameUseCase->__invoke();

        die();
        $response = MessagesHelpers::formatGamesList($games);
        
        return $response;
    }
}