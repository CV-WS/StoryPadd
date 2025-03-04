<?php

namespace App\Entity;

class Story
{
    private int $id;
    private string $title;
    private ?string $summary;
    private bool $published;
    private int $numberReadings;
    private ?string $createdAt;
    private ?int $idUser;
    private ?int $idCategory;
    private ?string $image;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(?string $summary): void
    {
        $this->summary = $summary;
    }

    public function getNumberReadings(): int
    {
        return $this->numberReadings;
    }

    public function setNumberReadings(int $numberReadings): void
    {
        $this->numberReadings = $numberReadings;
    }

    public function isPublished(): bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): void
    {
        $this->published = $published;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(?int $idUser): void
    {
        $this->idUser = $idUser;
    }

    public function getIdCategory(): ?int
    {
        return $this->idCategory;
    }

    public function setIdCategory(?int $idCategory): void
    {
        $this->idCategory = $idCategory;
    }


}