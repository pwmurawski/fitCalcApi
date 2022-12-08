<?php

declare(strict_types=1);

namespace App\SelectedProduct\Factory;

use App\SelectedProduct\Entity\ValueObject\FoodProduct;
use App\Meal\Entity\Meal;
use App\SelectedProduct\Entity\SelectedProduct;
use DateTimeInterface;
use Symfony\Component\Uid\Uuid;

interface SelectedProductFactoryInterface
{
    public function create(
        Uuid $id,
        Uuid $userId,
        Meal $mealId,
        FoodProduct $foodProductId,
        float $weight,
        DateTimeInterface $dateTime,
    ): SelectedProduct;
}
