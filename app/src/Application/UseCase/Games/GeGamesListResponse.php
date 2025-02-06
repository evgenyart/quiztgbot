<?php

declare(strict_types=1);

namespace App\Application\UseCase\Games;

class GeGamesListResponse
{
    public function __construct(
        public iterable $gamesList
    ) {
    }
}