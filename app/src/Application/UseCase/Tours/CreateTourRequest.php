<?php

declare(strict_types=1);

namespace App\Application\UseCase\Tours;

class CreateTourRequest
{
    public function __construct(
        public readonly string $name, 
        public readonly int $gameId
    )
    {
    }
}