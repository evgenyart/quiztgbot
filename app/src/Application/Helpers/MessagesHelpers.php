<?php

declare(strict_types=1);

namespace App\Application\Helpers;

use App\Application\UseCase\Games\GetGamesListResponse;
use Psr\Log\LoggerInterface;

class MessagesHelpers
{
    public static function formatGamesList(GetGamesListResponse $gamesListResponse): string
    {
        $message = "Список доступных квизов в базе: \n\n";
        foreach($gamesListResponse->gamesList as $oneGame) {
            $message .= $oneGame['id'] ." - ".$oneGame['name']. "\n";
        }

        $message .= "\nЧтобы запустить игру, наберите команду /start <ID>";

        return $message;
    }
}
