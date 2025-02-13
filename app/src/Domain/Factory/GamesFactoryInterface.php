<?php

declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Entity\Games;

interface GamesFactoryInterface
{
    public function create(string $name, int $numTours, int $numQuestions): Games;
}