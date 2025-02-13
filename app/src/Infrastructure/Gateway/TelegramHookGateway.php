<?php

declare(strict_types=1);

namespace App\Infrastructure\Gateway;

use App\Application\Gateway\TelegramHookGatewayInterface;
use App\Application\Gateway\SiteGatewayRequest;

class TelegramHookGateway implements TelegramHookGatewayInterface
{
    public function processHook(SiteGatewayRequest $request)
    {

    }
}