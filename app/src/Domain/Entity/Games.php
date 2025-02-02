<?php

declare(strict_types=1);

namespace App\Domain\Entity;

class Games
{
    private ?int $id = null;

    public function __construct(
        private string $name,
        private int $numTours,
        private int $numQuestions
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNumToues(): int
    {
        return $this->numTours;
    }

    public function getNumQuestions(): int
    {
        return $this->numQuestions;
    }
}