<?php

declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Entity\Sessions;
use App\Domain\Repository\SessionRepositoryInterface;

class SessionsService
{
    public function __construct(private SessionRepositoryInterface $sessionsRepository)
    {

    }

    public function getSessionByUserGame($userId, $gameId)
    {
        return $this->sessionsRepository->findByUserAndGame($userId, $gameId);
    }

    public function addSession(Sessions $session): void
    {
        $this->sessionsRepository->save($session);
    }

    public function closeSession($sessionId): void
    {
        $this->sessionsRepository->closeSession($sessionId);
    }

    public function closeSessionsExcept($internalUserId, $sessionId): void
    {
        $this->sessionsRepository->closeSessionsExcept($internalUserId, $sessionId);
    }

    public function setLastQuestionId($userSessionId, $questionId): void
    {
        $this->sessionsRepository->updateQuestionId($userSessionId, $questionId);
    }

    public function getActiveSessionQuestionId($internalUserId)
    {
        return $this->sessionsRepository->findByUserActiveSession($internalUserId);
    }
}