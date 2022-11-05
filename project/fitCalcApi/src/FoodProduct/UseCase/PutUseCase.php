<?php

declare(strict_types=1);

namespace App\FoodProduct\UseCase;

use App\FoodProduct\DTO\FoodProduct;
use App\FoodProduct\Exception\FoodProductNotFoundException;
use App\FoodProduct\Repository\FoodProductRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;

class PutUseCase
{
    public function __construct(private FoodProductRepositoryInterface $foodProductRepository)
    {
    }

    public function execute(FoodProduct $foodProductData): void
    {
        $foodProduct = $this->foodProductRepository->getByFoodProductIdUserId(
            $foodProductData->getId(),
            $foodProductData->getUserId(),
        );

        if (!$foodProduct)
            throw new FoodProductNotFoundException('Food Product not found', Response::HTTP_NOT_FOUND);

        $foodProduct->setName($foodProductData->getName());
        $foodProduct->setKcal($foodProductData->getKcal());
        $foodProduct->setProtein($foodProductData->getProtein());
        $foodProduct->setFat($foodProductData->getFat());
        $foodProduct->setCarbs($foodProductData->getCarbs());
        $foodProduct->setCode($foodProductData->getCode());

        $this->foodProductRepository->save($foodProduct);
    }
}
