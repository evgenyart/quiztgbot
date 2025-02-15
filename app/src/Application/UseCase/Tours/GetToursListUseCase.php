<?php

declare(strict_types=1);

namespace App\Application\UseCase\Tours;

use App\Domain\Repository\ToursRepositoryInterface;
use App\Application\UseCase\Tours\GetToursListResponse;

class GetToursListUseCase
{
    public function __construct(
        private readonly ToursRepositoryInterface $toursRepository
    ) {
    }

    public function __invoke(): GetToursListResponse
    {
        $result = [];

        $toursList = $this->toursRepository->findAll();

        foreach ($toursList as $oneTour) {
            $result[] = [
                'id' => $oneTour->getId(),
                'name' => $oneTour->getName(),
                'game_id' => $oneTour->getGameId(),
                'tour_num' => $oneTour->getTourNum(),
                'created_at' => $oneTour->getCreatedAt(),
                'updated_at' => $oneTour->getUpdatedAt()
            ];
        }

        return new GetToursListResponse($result);
    }
}
