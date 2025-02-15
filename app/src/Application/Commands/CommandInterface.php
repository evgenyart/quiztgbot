<?php

declare(strict_types=1);

namespace App\Application\Commands;

interface CommandInterface
{
    public function execute(string $message = '', int $userId = 0): string;
}
