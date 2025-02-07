<?php

declare(strict_types=1);

namespace App\Application\UseCase\Questions;

class CreateQuestionRequest
{
    public function __construct(
        public readonly int $tourId, 
        public readonly int $questionNum,
        public readonly string $text,
        public readonly string $answer
    )
    {
    }
}