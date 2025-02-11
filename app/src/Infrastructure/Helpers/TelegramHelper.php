<?php

declare(strict_types=1);

namespace App\Infrastructure\Helpers;

class TelegramHelper
{
    public static function getChatIdTextUser($body): iterable
    {
        $key = "message";

        if (isset($body['edited_message'])) {
            $key = "edited_message";
        }

        if(isset($body['edited_message']) || isset($body['message'])) {
            $chatId = $body[$key]['chat']['id'];
            $text = $body[$key]['text'];
            $userId = $body[$key]['from']['id'];

            return ['chatId' => $chatId, 'text' => $text, 'userId' => $userId];
        }
    }

    public static function getArguments($body): iterable
    {
        return explode(" ", $body);
    }
}