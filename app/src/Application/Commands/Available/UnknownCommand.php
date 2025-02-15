<?php

declare(strict_types=1);

namespace App\Application\Commands\Available;

use App\Application\Commands\CommandInterface;

class UnknownCommand implements CommandInterface
{
    public function execute(string $message = "", int $userId = 0): string
    {
        return "\xE2\x9D\x97 Команда не найдена. Для просмотра списка доступных команд введите /help";
    }
}
