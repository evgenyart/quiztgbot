<?php

declare(strict_types=1);

namespace App\Infrastructure\Service;

use Telegram\Bot\Api;
use Psr\Log\LoggerInterface;
use App\Application\UseCase\TgLogs\CreateTgLogRequest;
use App\Application\UseCase\TgLogs\CreateTgLogUseCase;
use App\Application\Helpers\TelegramHelper;
use App\Infrastructure\Service\Handlers\CommandHandler;
use App\Infrastructure\Service\Handlers\NoCommandHandler;
use App\Infrastructure\Service\LoadConfig;

class TelegramBotService
{
    private $telegram;

    public function __construct(
        private CreateTgLogUseCase $tgLogUseCase,
        private LoggerInterface $logger,
        private CommandHandler $commandHandler,
        private NoCommandHandler $noCommandHandler
    ) {
        $apiKey = LoadConfig::loadConfigParam('TELEGRAM_BOT_TOKEN');

        try {
            $this->telegram = new Api($apiKey);
        } catch (\Exception $e) {
            $logger->error($e->getMessage());
        }

        $this->commandHandler->setNext($this->noCommandHandler);
    }

    public function handleUpdate($update): void
    {
        #запишем в базу лог
        $logRequest = new CreateTgLogRequest(json_encode($update, JSON_UNESCAPED_UNICODE));
        ($this->tgLogUseCase)($logRequest);
        
        $arMessageParams = TelegramHelper::getChatIdTextUser($update);

        if (isset($arMessageParams['chatId']) && $arMessageParams['text']) {
            $this->commandHandler->handle($arMessageParams, $this->telegram);
        }
    }
}
