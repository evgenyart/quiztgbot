<?php

declare(strict_types=1);

namespace App\Application\Gateway;

class TelegramHookGatewayRequest
{
    public function __construct(public readonly string $body)
    {
    }
}