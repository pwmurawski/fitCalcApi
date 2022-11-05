<?php

declare(strict_types=1);

namespace App\SelectedProduct\UseCase;

use App\FoodProduct\Repository\FoodProductRepositoryInterface;
use App\Meal\Repository\MealRepositoryInterface;
use Symfony\Component\Uid\Uuid;
use App\SelectedProduct\DTO\SelectedProduct;
use App\SelectedProduct\Factory\SelectedProductFactoryInterface;
use App\SelectedProduct\Repository\SelectedProductRepositoryInterface;

class PostUseCase
{
    public function __construct(
        private SelectedProductFactoryInterface $selectedProductFactory,
        private SelectedProductRepositoryInterface $selectedProductRepository,
        private MealRepositoryInterface $mealRepository,
        private FoodProductRepositoryInterface $foodProductRepository,
    ) {
    }

    public function execute(SelectedProduct $selectedProductData): void
    {
        $selectedProduct = $this->selectedProductFactory->create(
            $selectedProductData->getId(),
            $selectedProductData->getUserId(),
            $this->mealRepository->getById(new Uuid($selectedProductData->getMealId())),
            $this->foodProductRepository->getById(new Uuid($selectedProductData->getFoodProductId())),
            $selectedProductData->getWeight(),
            $selectedProductData->getDateTime(),
        );

        $this->selectedProductRepository->save($selectedProduct);
    }
}
