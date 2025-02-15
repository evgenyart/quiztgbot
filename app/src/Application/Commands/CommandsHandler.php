<?php

declare(strict_types=1);

namespace App\Application\Commands;

use Psr\Log\LoggerInterface;
use App\Application\Commands\CommandFactory;

class CommandsHandler
{
    public function __construct(private LoggerInterface $logger, private CommandFactory $commandFactory)
    {
    }

    public function handle(string $commandName, string $message, int $userId = 0): string
    {
        $this->logger->warning($commandName);
        $command = $this->commandFactory->createCommand($commandName);

        return $command->execute($message, $userId);
    }
}
