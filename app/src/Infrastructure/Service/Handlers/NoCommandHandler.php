<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Handlers;

use App\Application\Telegram\MessageHandler;
use App\Application\Helpers\ProcessHelper;
use Telegram\Bot\Api;

class NoCommandHandler extends AbstractHandler
{

    public function __construct(private MessageHandler $messageHandler, private ProcessHelper $processHelper)
    {
    }

    public function handle(array $arMessageParams, Api $telegram): void
    {
        $this->goProcessMessage($arMessageParams, $telegram);
        $this->goNextStep($arMessageParams, $telegram);
    }
    private function goProcessMessage(array $arMessageParams, Api $telegram): void
    {
        #возможно это ответ на вопрос или какой-то мусор
        $result = $this->messageHandler->processMessage($arMessageParams['userId'], $arMessageParams['text']);
        if (strlen($result)) {
            $this->sendTelegramMessage($telegram, $arMessageParams['chatId'], $result);
        }
        #небольшая задержка, чтобы не сразу два сообщения прилетали в чат
        usleep(8000);
    }
    private function goNextStep(array $arMessageParams, Api $telegram): void
    {
        #тут надо проверить что выводить дальше - следующий вопрос, результаты или ничего
        $resultNext = $this->processHelper->showNextStep($arMessageParams['userId']);
        if (strlen((string)$resultNext)) {
            $this->sendTelegramMessage($telegram, $arMessageParams['chatId'], $resultNext);
        }
    }
}
