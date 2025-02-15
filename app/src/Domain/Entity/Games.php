<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Infrastructure\Repository\GamesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GamesRepository::class)]
class Games
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $numTours = null;

    #[ORM\Column]
    private ?int $numQuestions = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    public function __construct(
        $name,
        $numTours,
        $numQuestions
    ) {
        $this->name = $name;
        $this->numTours = $numTours;
        $this->numQuestions = $numQuestions;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getNumTours(): ?int
    {
        return $this->numTours;
    }

    public function setNumTours(int $numTours): static
    {
        $this->numTours = $numTours;

        return $this;
    }

    public function getNumQuestions(): ?int
    {
        return $this->numQuestions;
    }

    public function setNumQuestions(int $numQuestions): static
    {
        $this->numQuestions = $numQuestions;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
