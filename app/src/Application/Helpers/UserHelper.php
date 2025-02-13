<?php

declare(strict_types=1);

namespace App\Application\Helpers;

use App\Domain\Services\UsersService;

class UserHelper
{
    public function __construct(private UsersService $usersService)
    {
    }

    public function getInternalUserId(int $userId): int
    {
        $user = $this->usersService->getUserByExternalId($userId);
        if (!$user) {
            $user = new Users($userId);
            $this->usersService->addUser($user);
        }

        return $user->getId();
    }
}