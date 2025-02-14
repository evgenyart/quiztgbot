<?php

declare(strict_types=1);

namespace App\Application\UseCase\TgLogs;

class CreateTgLogRequest
{
    public function __construct(
        public readonly string $body
    ) {
    }
}
