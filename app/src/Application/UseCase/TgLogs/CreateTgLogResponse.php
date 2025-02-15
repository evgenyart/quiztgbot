<?php

declare(strict_types=1);

namespace App\Application\UseCase\TgLogs;

class CreateTgLogResponse
{
    public function __construct(public int $id)
    {
    }
}
