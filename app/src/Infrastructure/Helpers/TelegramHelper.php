<?php

declare(strict_types=1);

namespace App\Infrastructure\Helpers;

class TelegramHelper
{
    public static function getChatIdText($body): iterable
    {
        if (isset($body['message'])) {

            $chatId = $body['message']['chat']['id'];
            $text = $body['message']['text'];

            return ['chatId' => $chatId, 'text' => $text];
        }
    }
}