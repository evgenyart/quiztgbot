<?php

declare(strict_types=1);

namespace App\Application\UseCase\Game;

use App\Application\Helpers\SessionHelper;
use App\Application\Helpers\UserHelper;

class StopGameUseCase
{
    public function __construct(
        private SessionHelper $sessionHelper,
        private UserHelper $userHelper
    )
    {
    }

    public function __invoke(int $userId): string
    {
        $internalUserId = $this->userHelper->getInternalUserId($userId);
        $this->sessionHelper->closeSessionsExcept($internalUserId);

        return "\xF0\x9F\x93\x95 активная игровая сессия была закрыта";
    }
}