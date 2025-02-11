<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Users;

interface UsersRepositoryInterface
{
    public function findByExternalId(int $externalId): ?Users;
    public function save(Users $user): void;
}