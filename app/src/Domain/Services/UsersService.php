<?php

declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Entity\Users;
use App\Domain\Repository\UsersRepositoryInterface;

class UsersService
{
    public function __construct(private UsersRepositoryInterface $usersRepository)
    {
        #$this->usersRepository = $usersRepository;
    }

    public function getUserById(int $id)
    {
        return $this->usersRepository->findByExternalId($id);
    }

    public function addUser(Users $user): void
    {
        $this->usersRepository->save($user);
    }
}