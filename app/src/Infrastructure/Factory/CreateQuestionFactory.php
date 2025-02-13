<?php

declare(strict_types=1);

namespace App\Infrastructure\Factory;

use App\Domain\Factory\QuestionsFactoryInterface;
use App\Domain\Entity\Questions;

class CreateQuestionFactory implements QuestionsFactoryInterface
{
    public function create(int $tourId, int $questionNum, string $text, string $answer): Questions
    {
        return new Questions(
            $tourId,
            $questionNum,
            $text,
            $answer
        );
    }
}