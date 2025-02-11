<?php

declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Entity\Games;
use App\Domain\Repository\GamesRepositoryInterface;

class GamesService
{
    private GamesRepositoryInterface $gamesRepository;

    public function __construct(GamesRepositoryInterface $gamesRepository)
    {
        $this->gamesRepository = $gamesRepository;
    }

    public function getAllGames(): array
    {
        return $this->gamesRepository->findAll();
    }

    public function getGameById(int $id): array
    {
        return $this->gamesRepository->findById($id);
    }

    public function addGame(Games $game): void
    {
        $this->gamesRepository->save($game);
    }
}