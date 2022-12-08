<?php

declare(strict_types=1);

namespace App\SelectedProduct\Factory;

use App\SelectedProduct\Entity\ValueObject\FoodProduct;
use App\Meal\Entity\Meal;
use Symfony\Component\Uid\Uuid;
use App\SelectedProduct\Entity\SelectedProduct;
use DateTimeInterface;

class SelectedProductFactory implements SelectedProductFactoryInterface
{
    public function create(
        Uuid $id,
        Uuid $userId,
        Meal $meal,
        FoodProduct $foodProduct,
        float $weight,
        DateTimeInterface $dateTime
    ): SelectedProduct {
        return new SelectedProduct($id, $userId, $meal, $foodProduct, $weight, $dateTime);
    }
}
