<?php

declare(strict_types=1);

namespace App\FoodProduct\UseCase;

use App\FoodProduct\DTO\FoodProduct;
use App\FoodProduct\Factory\FoodProductFactoryInterface;
use App\FoodProduct\Repository\FoodProductRepositoryInterface;

class PostUseCase
{
    public function __construct(
        private FoodProductFactoryInterface $foodProductFactory,
        private FoodProductRepositoryInterface $foodProductRepository
    ) {
    }

    public function execute(FoodProduct $foodProductData): void
    {
        $foodProduct = $this->foodProductFactory->create(
            $foodProductData->getId(),
            $foodProductData->getUserId(),
            $foodProductData->getName(),
            $foodProductData->getKcal(),
            $foodProductData->getProtein(),
            $foodProductData->getFat(),
            $foodProductData->getCarbs(),
            $foodProductData->getCode(),
        );

        $this->foodProductRepository->save($foodProduct);
    }
}
