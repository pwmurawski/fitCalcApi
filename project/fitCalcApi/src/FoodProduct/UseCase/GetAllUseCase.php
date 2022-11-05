<?php

declare(strict_types=1);

namespace App\FoodProduct\UseCase;

use App\FoodProduct\Repository\FoodProductRepositoryInterface;

class GetAllUseCase
{
    public function __construct(private FoodProductRepositoryInterface $foodProductRepository)
    {
    }

    public function execute(): array
    {
        return $this->foodProductRepository->getAll();
    }
}
