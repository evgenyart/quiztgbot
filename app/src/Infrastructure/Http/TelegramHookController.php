<?php

declare(strict_types=1);

namespace App\Infrastructure\Http;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Application\Gateway\TelegramHookGatewayInterface;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use App\Application\Gateway\TelegramHookGatewayRequest;
use Symfony\Component\HttpFoundation\Request;
use Psr\Log\LoggerInterface;
use App\Infrastructure\Service\TelegramBotService;

class TelegramHookController extends AbstractFOSRestController
{
    public function __construct(TelegramBotService $telegramBotService
    )
    {
        $this->telegramBotService = $telegramBotService;
    }

    #[Route('/api/v1/hook', name: 'get_hook', methods: ['POST'])]
    public function __invoke(Request $request, LoggerInterface $logger): Response
    {
        $content = $request->getContent();
        #залогируем запрос
        $logger->info($content);

        $contentDecode = json_decode($content, true);
        $this->telegramBotService->handleUpdate($contentDecode);

        return new Response(json_encode([]), 200);
    }
}