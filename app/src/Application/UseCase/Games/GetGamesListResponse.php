<?php

declare(strict_types=1);

namespace App\Application\UseCase\Games;

class GetGamesListResponse
{
    public function __construct(
        public iterable $gamesList
    ) {
    }
}
