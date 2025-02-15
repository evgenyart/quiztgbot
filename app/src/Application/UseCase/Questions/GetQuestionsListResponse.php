<?php

declare(strict_types=1);

namespace App\Application\UseCase\Questions;

class GetQuestionsListResponse
{
    public function __construct(
        public iterable $questionsList
    ) {
    }
}
