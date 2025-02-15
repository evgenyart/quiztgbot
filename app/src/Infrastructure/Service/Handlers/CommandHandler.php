<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Handlers;

use App\Infrastructure\Service\Handlers\AbstractHandler;
use App\Application\Helpers\TelegramHelper;
use App\Application\Commands\CommandsHandler;
use Telegram\Bot\Api;

class CommandHandler extends AbstractHandler
{
    public function __construct(private CommandsHandler $commandsHandler)
    {
    }

    public function handle(array $arMessageParams, Api $telegram): void
    {
        if (TelegramHelper::checkIsCommand($arMessageParams['text'])) {
            #получить название команды
            $commandName = TelegramHelper::getNameCommand($arMessageParams['text']);

            #сделать действие для команды, вернуть текстовый ответ
            $commandResponse = $this->commandsHandler->handle($commandName, $arMessageParams['text'], $arMessageParams['userId']);

            #отправим ответное сообщение в чат
            if (strlen((string)$commandResponse)) {
                $this->sendTelegramMessage($telegram, $arMessageParams['chatId'], $commandResponse);
            }
        } else {
            parent::handle($arMessageParams, $telegram);
        }
    }
}
