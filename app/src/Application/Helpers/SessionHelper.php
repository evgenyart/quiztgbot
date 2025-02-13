<?php

declare(strict_types=1);

namespace App\Application\Helpers;

use App\Domain\Entity\Sessions;
use App\Domain\Services\SessionsService;

class SessionHelper
{
    public function __construct(private SessionsService $sessionsService)
    {
    }

    public function getActiveSessionLastQuestionId($internalUserId)
    {
        return $this->sessionsService->getActiveSessionQuestionId($internalUserId);
    }

    public function closeSession($sessionId): void
    {
        $this->sessionsService->closeSession($sessionId);
    }

    public function closeSessionsExcept($internalUserId, $sessionId = null): void
    {
        $this->sessionsService->closeSessionsExcept($internalUserId, $sessionId);
    }

    public function getSessionsGameByUser($internalUserId, $gameId): int
    {
        $session = $this->sessionsService->getSessionByUserGame($internalUserId, $gameId);
        $dateNow = new \DateTime('now');

        #если сессий не было ещё - то создадим
        if(!$session) {
            $session = new Sessions($internalUserId, $gameId, $dateNow);
            $this->sessionsService->addSession($session);
        }

        return $session->getId();
    }
}