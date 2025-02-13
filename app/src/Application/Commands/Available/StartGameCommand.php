<?php

declare(strict_types=1);

namespace App\Application\Commands\Available;

use App\Application\Commands\CommandInterface;
use App\Application\UseCase\Game\ProcessGameUseCase;
use Psr\Log\LoggerInterface;
use App\Application\Helpers\MessagesHelpers;
use App\Infrastructure\Helpers\TelegramHelper;

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

    public function execute(string $message = "", int $userId = 0): ?string
    {
        $response = "";

        $arguments = TelegramHelper::getArguments($message);

        if(isset($arguments[1])) {
            #тут передаем ID игры и ID пользователя
            $response = $this->processGameUseCase->__invoke((int)$arguments[1], (int)$userId);
        } else {
            $response = "\xE2\x9D\x97 Необходимо ввести ID игры, например /start 1";
        }
        
        return $response;
    }
}