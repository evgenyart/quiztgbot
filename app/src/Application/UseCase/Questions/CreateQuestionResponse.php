<?php

declare(strict_types=1);

namespace App\Application\UseCase\Questions;

class CreateQuestionResponse
{
    public function __construct(public int $id)
    {
    }
}
