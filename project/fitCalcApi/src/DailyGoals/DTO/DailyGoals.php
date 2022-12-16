<?php

declare(strict_types=1);

namespace App\DailyGoals\DTO;

use Symfony\Component\Uid\Uuid;

class DailyGoals
{
    public function __construct(
        private Uuid $id,
        private Uuid $userId,
        private float $kcal,
        private float $protein,
        private float $fat,
        private float $carbs,
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
}
