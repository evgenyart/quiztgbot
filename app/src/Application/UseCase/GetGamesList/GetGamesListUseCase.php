<?php

declare(strict_types=1);

namespace App\Application\UseCase\GetGamesList;

use App\Domain\Repository\GamesRepositoryInterface;

class GetGamesListUseCase
{
    public function __construct(
        private readonly GamesRepositoryInterface $gamesRepository
    ) {
    }

    public function __invoke() #: GetNewsListResponse
    {
        $result = [];

        $gamesList = $this->gamesRepository->findAll();

        // foreach ($newsList as $oneNews) {
        //     $result[] = [
        //     'id' => $oneNews->getId(),
        //     'date' => $oneNews->getDate()->getValue()->format("Y-m-d H:i:s"),
        //     'url' => $oneNews->getUrl()->getValue(),
        //     'title' => $oneNews->getTitle()->getValue()
        //     ];
        // }

        // return new GetNewsListResponse($result);
    }
}