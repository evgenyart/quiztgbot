<?php

declare(strict_types=1);

namespace App\Application\UseCase\Game;

use App\Application\Helpers\SessionHelper;
use App\Application\Helpers\UserHelper;

class StopGameUseCase
{
    private const SUCCESS_MESSAGE = "\xF0\x9F\x93\x95 активная игровая сессия была закрыта";
    public function __construct(
        private SessionHelper $sessionHelper,
        private UserHelper $userHelper
    ) {
    }

    public function __invoke(int $userId): string
    {
        #для упрощения - не проверяем входящие, промежуточные значения
        $internalUserId = $this->userHelper->getInternalUserId($userId);
        $this->sessionHelper->closeSessionsExcept($internalUserId);

        return self::SUCCESS_MESSAGE;
    }
}
