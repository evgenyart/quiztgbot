<?php

declare(strict_types=1);

namespace App\Application\UseCase\Questions;

use App\Domain\Repository\QuestionsRepositoryInterface;

class GetQuestionsListUseCase
{
    public function __construct(
        private readonly QuestionsRepositoryInterface $questionsRepository
    ) {
    }

    public function __invoke(): GetQuestionsListResponse
    {
        $result = [];

        $questionsList = $this->questionsRepository->findAll();

        foreach ($questionsList as $oneQuestion) {
            $result[] = [
                'id' => $oneQuestion->getId(),
                'tour_id' => $oneQuestion->getTourId(),
                'question_num' => $oneQuestion->getQuestionNum(),
                'text' => $oneQuestion->getText(),
                'answer' => $oneQuestion->getAnswer(),
                'created_at' => $oneQuestion->getCreatedAt(),
                'updated_at' => $oneQuestion->getUpdatedAt()
            ];
        }

        return new GetQuestionsListResponse($result);
    }
}