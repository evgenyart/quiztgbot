<?php

declare(strict_types=1);

namespace App\Infrastructure\Http;

use App\Application\UseCase\Tours\CreateTourRequest;
use App\Application\UseCase\Tours\CreateTourUseCase;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

class CreateTourController extends AbstractFOSRestController
{
    public function __construct(
        private CreateTourUseCase $useCase,
    ) {
    }
    
    #[Route('/api/v1/tour', name: 'create_tour', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload] CreateTourRequest $request
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