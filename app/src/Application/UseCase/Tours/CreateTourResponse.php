<?php

declare(strict_types=1);

namespace App\Application\UseCase\Tours;

class CreateTourResponse
{
    public function __construct(public int $id)
    {
    }
}
