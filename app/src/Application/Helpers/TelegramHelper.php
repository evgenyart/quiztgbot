<?php

declare(strict_types=1);

namespace App\Application\Helpers;

use App\Application\UseCase\Games\GetGamesListResponse;

class TelegramHelper
{
    public static function getChatIdTextUser($body): iterable
    {
        $key = "message";

        if (isset($body['edited_message'])) {
            $key = "edited_message";
        }

        if (isset($body['edited_message']) || isset($body['message'])) {
            $chatId = $body[$key]['chat']['id'];
            $text = $body[$key]['text'];
            $userId = $body[$key]['from']['id'];

            return ['chatId' => $chatId, 'text' => $text, 'userId' => $userId];
        } else {
            return [];
        }
    }

    public static function getArguments($body): iterable
    {
        return explode(" ", $body);
    }

    public static function getNameCommand($text): string
    {
        return strtok($text, ' ');
    }

    public static function checkIsCommand($text): bool
    {
        return (strpos($text, '/') === 0) ? true : false;
    }

    public static function formatGamesList(GetGamesListResponse $gamesListResponse): string
    {
        $message = "Список доступных квизов в базе: \n\n";
        foreach ($gamesListResponse->gamesList as $oneGame) {
            $message .= $oneGame['id'] . " - " . $oneGame['name'] . "\n";
        }

        $message .= "\nЧтобы запустить игру, наберите команду /start <ID>";

        return $message;
    }
}
