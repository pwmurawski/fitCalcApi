<?php

declare(strict_types=1);

namespace App\FoodProduct\Factory;

use App\FoodProduct\Entity\FoodProduct;
use Symfony\Component\Uid\Uuid;

class FoodProductFactory implements FoodProductFactoryInterface
{
    public function create(
        Uuid $id,
        Uuid $userId,
        string $name,
        float $kcal,
        float $protein,
        float $fat,
        float $carbs,
        ?string $code
    ): FoodProduct {
        return new FoodProduct($id, $userId, $name, $kcal, $protein, $fat, $carbs, $code);
    }
}
