<?php

declare(strict_types=1);

namespace App\Meal\Factory;

use App\Meal\Entity\Meal;
use Symfony\Component\Uid\Uuid;

interface MealFactoryInterface
{
    public function create(Uuid $id, string $name): Meal;
}
