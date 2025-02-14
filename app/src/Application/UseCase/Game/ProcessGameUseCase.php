<?php

declare(strict_types=1);

namespace App\Application\UseCase\Game;

use App\Application\Helpers\UserHelper;
use App\Application\Helpers\SessionHelper;
use App\Application\UseCase\Game\Handlers\AbstractGameHandler;
use App\Domain\Services\QuestionsService;
use App\Domain\Services\GamesService;
use App\Domain\Services\UserAnswersService;
use App\Domain\Services\UsersService;
use App\Domain\Services\SessionsService;
use App\Application\Helpers\QuestionHelper;
use App\Application\UseCase\Game\Handlers\GameExistsHandler;
use App\Application\UseCase\Game\Handlers\QuestionsExistHandler;
use App\Application\UseCase\Game\Handlers\UserIdHandler;
use App\Application\UseCase\Game\Handlers\SessionHandler;
use App\Application\UseCase\Game\Handlers\QuestionHandler;

class ProcessGameUseCase
{
    private AbstractGameHandler $abstractGameHandler;

    public function __construct(
        private QuestionsService $questionsService,
        private GamesService $gamesService,
        private UserAnswersService $userAnswersService,
        private UsersService $usersService,
        private SessionsService $sessionsService,
        private QuestionHelper $questionHelper,
        private SessionHelper $sessionHelper,
        private UserHelper $userHelper
    ) {

        $this->handlerChain = new GameExistsHandler($this->gamesService);
        $this->handlerChain
            ->setNext(new QuestionsExistHandler($this->gamesService))
            ->setNext(new UserIdHandler($this->userHelper))
            ->setNext(new SessionHandler($this->sessionHelper))
            ->setNext(new QuestionHandler($this->questionsService, $this->userAnswersService, $this->questionHelper));
    }

    public function __invoke(int $gameId, int $userId): string
    {
        return $this->handlerChain->handle($gameId, $userId);
    }
}
