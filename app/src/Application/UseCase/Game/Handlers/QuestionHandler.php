<?php

declare(strict_types=1);

namespace App\Application\UseCase\Game\Handlers;

use App\Application\UseCase\Game\Handlers\AbstractGameHandler;
use App\Domain\Services\QuestionsService;
use App\Domain\Services\UserAnswersService;
use App\Application\Helpers\QuestionHelper;

class QuestionHandler extends AbstractGameHandler
{
    public function __construct(
        private QuestionsService $questionsService,
        private UserAnswersService $userAnswersService,
        private QuestionHelper $questionHelper
    ) {
    }

    public function handle(int $gameId, int $userId, int $userSessionId): ?string
    {
        #определим, сколько вопросов есть в базе
        #$cntQuestions = $this->questionsService->getCountQuestions($gameId);

        #определим, сколько вопросов уже прошёл пользователь
        $cntAnswersSession = $this->userAnswersService->getCountAnswersBySession($userSessionId);

        #если это новая игра, то выдадим вопрос
        if ($cntAnswersSession == 0) {
            return $this->questionHelper->ShowQuestion($gameId, $userSessionId, []);
        } else {
            //TODO: тут можно описать случай, когда пользователь продолжает игру, если повторно её запустил
        }

        return parent::handle($gameId, $userId, $userSessionId);
    }
}
