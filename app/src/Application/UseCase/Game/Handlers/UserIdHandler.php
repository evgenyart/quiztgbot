<?php

declare(strict_types=1);

namespace App\Application\UseCase\Game\Handlers;

use App\Application\UseCase\Game\Handlers\AbstractGameHandler;
use App\Application\Helpers\UserHelper;

class UserIdHandler extends AbstractGameHandler
{
    public function __construct(private UserHelper $userHelper)
    {
    }

    public function handle(int $gameId, int $userId, int $userSessionId = 0): ?string
    {
        #проверить, есть ли пользователь в базе. если есть - вернуть внутренний id. если нет - создать
        $internalUserId = $this->userHelper->getInternalUserId($userId);
        return parent::handle($gameId, $internalUserId, $userSessionId);
    }
}
