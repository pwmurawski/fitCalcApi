<?php

declare(strict_types=1);

namespace App\SelectedProduct\DTO;

use Symfony\Component\Uid\Uuid;

class PutSelectedProduct
{
    public function __construct(
        private Uuid $id,
        private Uuid $userId,
        private float $weight,
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

    public function getWeight(): float
    {
        return $this->weight;
    }
}
