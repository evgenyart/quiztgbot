<?php

declare(strict_types=1);

namespace App\Infrastructure\Factory;

use App\Domain\Factory\TgLogsFactoryInterface;
use App\Domain\Entity\TgLogs;

class CreateTgLogsFactory implements TgLogsFactoryInterface
{
    public function create(string $body): TgLogs
    {
        return new TgLogs(
            $body
        );
    }
}
