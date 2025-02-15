<?php

declare(strict_types=1);

namespace App\Application\UseCase\Tours;

class GetToursListResponse
{
    public function __construct(
        public iterable $toursList
    ) {
    }
}
