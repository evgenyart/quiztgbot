<?php

declare(strict_types=1);

namespace App\Application\UseCase\Game\Handlers;

abstract class AbstractGameHandler
{
    private ?AbstractGameHandler $nextHandler = null;

    public function setNext(AbstractGameHandler $handler): AbstractGameHandler
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle(int $gameId, int $userId, int $userSessionId): ?string
    {
        if ($this->nextHandler) {
            return $this->nextHandler->handle($gameId, $userId, $userSessionId);
        }

        return null;
    }
}
