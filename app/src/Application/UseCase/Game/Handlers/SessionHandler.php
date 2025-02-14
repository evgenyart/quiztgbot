<?php

declare(strict_types=1);

namespace App\Application\UseCase\Game\Handlers;

use App\Application\UseCase\Game\Handlers\AbstractGameHandler;
use App\Application\Helpers\SessionHelper;

class SessionHandler extends AbstractGameHandler
{
    public function __construct(private SessionHelper $sessionHelper)
    {
    }

    public function handle(int $gameId, int $userId, $userSessionId): ?string
    {
        #определим сессию пользователя
        $userSessionId = $this->sessionHelper->getSessionsGameByUser($userId, $gameId);
        #если есть другие сесси пользователя, то закроем их всех
        $this->sessionHelper->closeSessionsExcept($userId, $userSessionId);
        return parent::handle($gameId, $userId, $userSessionId);
    }
}
