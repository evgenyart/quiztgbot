<?php

declare(strict_types=1);

namespace App\Application\UseCase\Games;

class CreateGameRequest
{
    public function __construct(
        public readonly string $name, 
        public readonly int $numTours, 
        public readonly int $numQuestions
    )
    {
    }
}