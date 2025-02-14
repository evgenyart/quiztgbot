<?php

declare(strict_types=1);

namespace App\Infrastructure\Http;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use App\Application\UseCase\Questions\GetQuestionsListUseCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Infrastructure\Service\TokenChecker;

class GetQuestionsListController extends AbstractFOSRestController
{
    public function __construct(
        private GetQuestionsListUseCase $useCase,
        private RequestStack $requestStack,
        private TokenChecker $tokenChecker
    ) {
    }

    #[Route('/api/v1/questions', name: 'questions_list', methods: ['GET'])]
    public function __invoke(): Response
    {
        $request = $this->requestStack->getCurrentRequest();
        $failedTokenCheck = $this->tokenChecker->check($request);

        if ($failedTokenCheck) {
            return $failedTokenCheck;
        } else {
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
}
