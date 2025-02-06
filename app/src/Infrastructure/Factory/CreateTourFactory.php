<?php

declare(strict_types=1);

namespace App\Infrastructure\Factory;

use App\Domain\Factory\ToursFactoryInterface;
use App\Domain\Entity\Tours;

class CreateTourFactory implements ToursFactoryInterface
{
    public function create(string $name, int $gameId): Tours
    {
        return new Tours(
            $name,
            $gameId
        );
    }
}