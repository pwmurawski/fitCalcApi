<?php

declare(strict_types=1);

namespace App\SelectedProduct\UseCase;

use App\FoodProduct\Repository\FoodProductRepositoryInterface;
use App\Meal\Repository\MealRepositoryInterface;
use Symfony\Component\Uid\Uuid;
use App\SelectedProduct\DTO\SelectedProduct;
use App\SelectedProduct\Factory\SelectedProductFactoryInterface;
use App\SelectedProduct\Repository\SelectedProductRepositoryInterface;
use App\SelectedProduct\Entity\ValueObject\FoodProduct;
use DateTime;

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
        $foodProduct = $this->foodProductRepository->getById(new Uuid($selectedProductData->getFoodProductId()));

        $foodProductVO = new FoodProduct(
            $foodProduct->getName(),
            $foodProduct->getKcal(),
            $foodProduct->getProtein(),
            $foodProduct->getFat(),
            $foodProduct->getCarbs(),
            $foodProduct->getCode()
        );

        $selectedProduct = $this->selectedProductFactory->create(
            $selectedProductData->getId(),
            $selectedProductData->getUserId(),
            $this->mealRepository->getById(new Uuid($selectedProductData->getMealId())),
            $foodProductVO,
            $selectedProductData->getWeight(),
            new DateTime($selectedProductData->getDateTime()),
        );

        $this->selectedProductRepository->save($selectedProduct);
    }
}
