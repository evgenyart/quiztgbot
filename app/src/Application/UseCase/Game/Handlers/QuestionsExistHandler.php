<?php

declare(strict_types=1);

namespace App\Application\UseCase\Game\Handlers;

use App\Application\UseCase\Game\Handlers\AbstractGameHandler;
use App\Domain\Services\GamesService;

class QuestionsExistHandler extends AbstractGameHandler
{
    public function __construct(private GamesService $gamesService)
    {
    }

    public function handle(int $gameId, int $userId, int $userSessionId = 0): ?string
    {
        if (!$this->gamesService->checkIssetQuestions($gameId)) {
            return "Для выбранной игры нет вопросов в базе. Выберите другую игру";
        }

        return parent::handle($gameId, $userId, $userSessionId);
    }
}
