<?php

declare(strict_types=1);

namespace App\Meal\UseCase;

use App\Meal\Repository\MealRepositoryInterface;

class GetAllUseCase
{
    public function __construct(private MealRepositoryInterface $mealRepository)
    {
    }

    public function execute(): array
    {
        return $this->mealRepository->getAll();
    }
}
