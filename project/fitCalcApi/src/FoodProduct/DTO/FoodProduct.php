<?php

declare(strict_types=1);

namespace App\FoodProduct\DTO;

use Symfony\Component\Uid\Uuid;

class FoodProduct
{
    public function __construct(
        private Uuid $id,
        private Uuid $userId,
        private string $name,
        private float $kcal,
        private float $protein,
        private float $fat,
        private float $carbs,
        private ?string $code = null
    ) {
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getUserId(): Uuid
    {
        return $this->userId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getKcal(): float
    {
        return $this->kcal;
    }

    public function getProtein(): float
    {
        return $this->protein;
    }

    public function getFat(): float
    {
        return $this->fat;
    }

    public function getCarbs(): float
    {
        return $this->carbs;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }
}
