<?php

declare(strict_types=1);

namespace App\Infrastructure\Http;

use App\Application\UseCase\TgLogs\CreateTgLogRequest;
use App\Application\UseCase\TgLogs\CreateTgLogUseCase;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

class CreateTgLogController extends AbstractFOSRestController
{
    public function __construct(
        private CreateTgLogUseCase $useCase,
    ) {
    }
    
    #[Route('/api/v1/tglog', name: 'create_tglog', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload] CreateTgLogRequest $request
    ): Response {
        try {
            $response = ($this->useCase)($request);
            return new Response(
                json_encode(
                    [
                    'id' => $response->id
                    ]
                ),
                201
            );
        } catch (\Throwable $e) {
            $errorResponse = [
                'message' => $e->getMessage()
            ];
            return new Response(json_encode($errorResponse), 400);
        }
    }
}