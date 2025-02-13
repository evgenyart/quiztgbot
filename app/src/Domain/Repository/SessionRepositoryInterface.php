<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Sessions;

interface SessionRepositoryInterface
{
    public function save(Sessions $session): void;

    public function findByUserAndGame($userId, $gameId);

    public function updateQuestionId($userSessionId, $questionId): void;

    public function findByUserActiveSession($internalUserId);
}