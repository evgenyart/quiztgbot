<?php

declare(strict_types=1);

namespace App\Application\UseCase\Games;

class CreateGameResponse
{
    public function __construct(public int $id)
    {
    }
}