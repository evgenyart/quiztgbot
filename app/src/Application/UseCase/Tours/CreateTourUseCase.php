<?php

declare(strict_types=1);

namespace App\Application\UseCase\Tours;

use App\Application\UseCase\Tours\CreateTourRequest;
use App\Application\UseCase\Tours\CreateTourResponse;
use App\Domain\Repository\ToursRepositoryInterface;
use App\Domain\Factory\ToursFactoryInterface;

class CreateTourUseCase
{
    public function __construct(
        private readonly ToursFactoryInterface $tourFactory,
        private readonly ToursRepositoryInterface $tourRepository
    ) {
    }

    public function __invoke(CreateTourRequest $request): CreateTourResponse
    {
        $tour = $this->tourFactory->create($request->name, $request->gameId, $request->tourNum);

        $this->tourRepository->save($tour);

        return new CreateTourResponse(
            $tour->getId()
        );
    }
}
