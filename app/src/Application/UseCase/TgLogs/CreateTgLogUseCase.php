<?php

declare(strict_types=1);

namespace App\Application\UseCase\TgLogs;

use App\Application\UseCase\TgLogs\CreateTgLogRequest;
use App\Application\UseCase\TgLogs\CreateTgLogResponse;
use App\Domain\Repository\TgLogsRepositoryInterface;
use App\Domain\Factory\TgLogsFactoryInterface;

class CreateTgLogUseCase
{
    public function __construct(
        private readonly TgLogsFactoryInterface $tgLogsFactory,
        private readonly TgLogsRepositoryInterface $tgLogsRepository
    )
    {
    }

    public function __invoke(CreateTgLogRequest $request): CreateTgLogResponse
    {
        $tgLog = $this->tgLogsFactory->create($request->body);

        $this->tgLogsRepository->save($tgLog);

        return new CreateTgLogResponse(
            $tgLog->getId()
        );
    }
}