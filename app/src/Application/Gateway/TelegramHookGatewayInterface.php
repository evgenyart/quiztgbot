<?php

declare(strict_types=1);

namespace App\Application\Gateway;

interface TelegramHookGatewayInterface
{
    public function processHook(SiteGatewayRequest $request);
}