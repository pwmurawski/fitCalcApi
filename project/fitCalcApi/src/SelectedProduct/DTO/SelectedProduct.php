<?php

declare(strict_types=1);

namespace App\SelectedProduct\DTO;

use DateTimeInterface;
use Symfony\Component\Uid\Uuid;

class SelectedProduct
{
    public function __construct(
        private Uuid $id,
        private Uuid $userId,
        private string $mealId,
        private string $foodProductId,
        private float $weight,
        private DateTimeInterface $dateTime,
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

    public function getMealId(): string
    {
        return $this->mealId;
    }

    public function getFoodProductId(): string
    {
        return $this->foodProductId;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function getDateTime(): DateTimeInterface
    {
        return $this->dateTime;
    }
}
