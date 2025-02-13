<?php

declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\Entity\UserAnswers;
use App\Domain\Repository\UserAnswersRepositoryInterface;

class UserAnswersService
{
    private UserAnswersRepositoryInterface $userAnswersRepository;

    public function __construct(UserAnswersRepositoryInterface $userAnswersRepository)
    {
        $this->userAnswersRepository = $userAnswersRepository;
    }

    public function getUserAnswerByFilter(iterable $filter): ?UserAnswers
    {
        return $this->userAnswersRepository->findByFilter($filter);
    }

    public function addUserAnswer(UserAnswers $userAnswer): void
    {
        $this->userAnswersRepository->save($userAnswer);
    }

    public function getCountAnswersBySession(int $sessionId): int
    {
        return $this->userAnswersRepository->getCountBySession($sessionId);
    }
}