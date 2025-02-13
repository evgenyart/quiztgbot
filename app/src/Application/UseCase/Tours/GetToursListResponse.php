<?php

declare(strict_types=1);

namespace App\Application\UseCase\Tours;

class GeToursListResponse
{
    public function __construct(
        public iterable $toursList
    ) {
    }
}