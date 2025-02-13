<?php

declare(strict_types=1);

namespace App\Application\Commands\Available;

use App\Application\Commands\CommandInterface;
use App\Application\UseCase\Game\StopGameUseCase;

class StopGamesCommand implements CommandInterface
{
    public function __construct(private StopGameUseCase $stopGameUseCase)
    {
    }

    public function execute(string $message = "", int $userId = 0): ?string
    {
        $response = $this->stopGameUseCase->__invoke((int)$userId);

        return $response;
    }
}