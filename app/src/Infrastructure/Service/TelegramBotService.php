<?php

declare(strict_types=1);

namespace App\Infrastructure\Service;


use App\Application\Helpers\ProcessHelper;
use Telegram\Bot\Api;
use Psr\Log\LoggerInterface;
use App\Application\UseCase\TgLogs\CreateTgLogRequest;
use App\Application\UseCase\TgLogs\CreateTgLogUseCase;
use App\Application\Helpers\TelegramHelper;
use App\Application\Commands\CommandHandler;
use App\Application\Telegram\MessageHandler;

class TelegramBotService
{
    private $telegram;
    private $tgLog;

    public function __construct(
        private CreateTgLogUseCase $TgLogUseCase,
        private LoggerInterface $logger,
        private CommandHandler $commandHandler,
        private MessageHandler $messageHandler,
        private ProcessHelper $processHelper
    )
    {
        #топорно
        $apiKey = $_ENV['TELEGRAM_BOT_TOKEN'];

        $this->tgLog = $TgLogUseCase;
        $this->logger = $logger;
        $this->commandHandler = $commandHandler;

        try {
            $this->telegram = new Api($apiKey);
        } catch (\Exception $e) {
            $logger->error($e->getMessage());
        }
    }

    public function handleUpdate($update)
    {
        #запишем в базу лог
        $logRequest = new CreateTgLogRequest(json_encode($update, JSON_UNESCAPED_UNICODE));
        ($this->tgLog)($logRequest);
        
        $arMessageParams = TelegramHelper::getChatIdTextUser($update);

        if(isset($arMessageParams['chatId']) && $arMessageParams['text']) {

            $chatId = $arMessageParams['chatId'];
            $message = $arMessageParams['text'];
            $userId =  $arMessageParams['userId'];

            #является ли введеная фраза коммандой - есть ли символ "/"
            if($this->checkIsCommand($message)) {

                #получить название команд
                $commandName = $this->getNameCommand($message);
                $this->logger->info($commandName);

                #сделать действие для команды, вернуть текстовый ответ
                $commandResponse = $this->commandHandler->handle($commandName, $message, $userId);

                #отправим ответное сообщение в чат
                if(strlen((string)$commandResponse)) {
                    $this->SendTelegramMessage($chatId, $commandResponse);
                }

            } else {
                #возможно это ответ на вопрос или какой-то мусор
                $result = $this->messageHandler->processMessage($userId, $message);
                if(strlen($result)) {
                    $this->SendTelegramMessage($chatId, $result);
                }
                usleep(8000);

                #тут надо проверить что выводить дальше - следующий вопрос, результаты или ничего
                $resultNext = $this->processHelper->showNextStep($userId);
                $resultNext = (string)$resultNext;
                if(strlen($resultNext)) {
                    $this->SendTelegramMessage($chatId, $resultNext);
                }
            }
        }
    }

    private function SendTelegramMessage($chatId, $message) {
        $response = $this->telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => $message,
        ]);
    }

    private function getNameCommand($text): string
    {
        return strtok($text, ' ');
    }

    private function checkIsCommand($text): bool
    {
        return (strpos($text, '/') === 0) ? true : false;
    }
}