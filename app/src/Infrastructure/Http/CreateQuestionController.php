<?php

declare(strict_types=1);

namespace App\Infrastructure\Http;

use App\Application\UseCase\Questions\CreateQuestionRequest;
use App\Application\UseCase\Questions\CreateQuestionUseCase;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

class CreateQuestionController extends AbstractFOSRestController
{
    public function __construct(
        private CreateQuestionUseCase $useCase,
    ) {
    }
    
    #[Route('/api/v1/question', name: 'create_question', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload] CreateQuestionRequest $request
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