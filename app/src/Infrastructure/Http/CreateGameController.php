<?php

declare(strict_types=1);

namespace App\Infrastructure\Http;

use App\Application\UseCase\Games\CreateGameRequest;
use App\Application\UseCase\Games\CreateGameUseCase;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Infrastructure\Service\TokenChecker;

class CreateGameController extends AbstractFOSRestController
{
    public function __construct(
        private CreateGameUseCase $useCase,
        private RequestStack $requestStack,
        private TokenChecker $tokenChecker
    ) {
    }
    
    #[Route('/api/v1/game', name: 'create_game', methods: ['POST'])]
    public function __invoke(
        #[MapRequestPayload] CreateGameRequest $request
    ): Response {

        $requestHeader = $this->requestStack->getCurrentRequest();
        $failedTokenCheck = $this->tokenChecker->check($requestHeader);

        if($failedTokenCheck) {
            return $failedTokenCheck;
        } else {

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
}