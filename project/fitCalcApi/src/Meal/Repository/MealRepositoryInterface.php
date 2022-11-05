<?php

declare(strict_types=1);

namespace App\Meal\Repository;

use Symfony\Component\Uid\Uuid;
use App\Meal\Entity\Meal;

interface MealRepositoryInterface
{
    public function save(Meal $meal): void;
    public function remove(Meal $meal): void;
    public function getById(Uuid $id): ?Meal;
    public function getAll(): array;
}
