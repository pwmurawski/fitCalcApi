<?php

declare(strict_types=1);

namespace App\FoodProduct\Repository;

use Symfony\Component\Uid\Uuid;
use App\FoodProduct\Entity\FoodProduct;

interface FoodProductRepositoryInterface
{
    public function save(FoodProduct $FoodProduct): void;
    public function remove(FoodProduct $FoodProduct): void;
    public function getByName(string $name): ?FoodProduct;
    public function getById(Uuid $id): ?FoodProduct;
    public function getAll(): array;
    public function getByFoodProductIdUserId(Uuid $id, Uuid $userId): ?FoodProduct;
}
