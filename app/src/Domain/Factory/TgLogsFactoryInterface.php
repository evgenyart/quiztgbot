<?php

declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Entity\TgLogs;

interface TgLogsFactoryInterface
{
    public function create(string $body): TgLogs;
}