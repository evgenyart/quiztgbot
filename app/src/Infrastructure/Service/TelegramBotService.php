<?php

declare(strict_types=1);

namespace App\Infrastructure\Service;

use Telegram\Bot\Api;
use Psr\Log\LoggerInterface;

class TelegramBotService
{
    private $telegram;

    public function __construct(LoggerInterface $logger)
    {
        #переделать получение
        $apiKey = $_ENV['TELEGRAM_BOT_TOKEN'];

        $logger->info($apiKey);

        try {
            $this->telegram = new Api($apiKey);
        } catch (\Exception $e) {
            $logger->error($e->getMessage());
        }
    }

    public function handleUpdate($update)
    {

    }
}