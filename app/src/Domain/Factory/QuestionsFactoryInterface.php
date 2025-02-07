<?php

declare(strict_types=1);

namespace App\Domain\Factory;

use App\Domain\Entity\Questions;

interface QuestionsFactoryInterface
{
    public function create(int $tourId, int $questionId, string $text, string $answer): Questions;
}