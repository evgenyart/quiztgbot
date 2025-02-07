<?php

declare(strict_types=1);

namespace App\Application\UseCase\Questions;

use App\Application\UseCase\Questions\CreateQuestionRequest;
use App\Application\UseCase\Questions\CreateQuestionResponse;
use App\Domain\Repository\QuestionsRepositoryInterface;
use App\Domain\Factory\QuestionsFactoryInterface;

class CreateQuestionUseCase
{
    public function __construct(
        private readonly QuestionsFactoryInterface $questionFactory,
        private readonly QuestionsRepositoryInterface $questionRepository
    )
    {
    }

    public function __invoke(CreateQuestionRequest $request): CreateQuestionResponse
    {
        $question = $this->questionFactory->create($request->tourId, $request->questionNum, $request->text, $request->answer);

        $this->questionRepository->save($question);

        return new CreateQuestionResponse(
            $question->getId()
        );
    }
}