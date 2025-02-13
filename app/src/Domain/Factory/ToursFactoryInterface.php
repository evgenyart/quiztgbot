<?php

declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Entity\Tours;

interface ToursFactoryInterface
{
    public function create(string $name, int $gameId, int $tourId): Tours;
}