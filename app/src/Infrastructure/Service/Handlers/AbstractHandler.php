<?php

namespace App\Infrastructure\Service\Handlers;

use Telegram\Bot\Api;

abstract class AbstractHandler
{
    private ?AbstractHandler $nextHandler = null;

    public function setNext(AbstractHandler $handler): AbstractHandler
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle(array $arMessageParams, Api $telegram): void
    {
        if ($this->nextHandler) {
            $this->nextHandler->handle($arMessageParams, $telegram);
        }
    }

    #сомненительно тут, но пока оставим
    protected function sendTelegramMessage(Api $telegram, $chatId, $message): void
    {
        $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $message,
        ]);
    }
}
