<?php

declare(strict_types=1);

namespace App\Infrastructure\Factory;

use App\Domain\Factory\GamesFactoryInterface;
use App\Domain\Entity\Games;

class CreateGameFactory implements GamesFactoryInterface
{
    public function create(string $name, int $numTours, int $numQuestions): Games
    {
        return new Games(
            $name,
            $numTours,
            $numQuestions
        );
    }
}
