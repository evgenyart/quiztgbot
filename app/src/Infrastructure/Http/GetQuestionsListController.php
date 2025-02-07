<?php

declare(strict_types=1);

namespace App\Infrastructure\Http;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use App\Application\UseCase\Questions\GetQuestionsListUseCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GetQuestionsListController extends AbstractFOSRestController
{
    public function __construct(
        private GetQuestionsListUseCase $useCase,
    ) {
    }

    #[Route('/api/v1/questions', name: 'questions_list', methods: ['GET'])]
    public function __invoke(): Response
    {
        try {
            $response = ($this->useCase)();
            return new Response(json_encode($response, JSON_UNESCAPED_UNICODE), 200);
        } catch (\Throwable $e) {
            $errorResponse = [
                'message' => $e->getMessage()
            ];
            return new Response(json_encode($errorResponse), 400);
        }
    }
}