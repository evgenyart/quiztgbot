<?php

declare(strict_types=1);

namespace App\Application\Commands\Available;

use App\Application\Commands\CommandInterface;

class HelpCommand implements CommandInterface
{
    public function execute(string $message = ""): ?string
    {
        $response = "\xF0\x9F\x91\x8D  Допустимые команды бота:  \xF0\x9F\x91\x8D\n\n";

        $response .= "/list - вывести список игр из базы \n";
        $response .= "/start ID - начать игру с выбранным ID \n";
        $response .= "/stop - остановить текущую игру \n";
        $response .= "/help - вывести список команд бота";

        return $response;
    }
}