<?php

declare(strict_types=1);

namespace App\FoodProduct\UseCase;

use Symfony\Component\Uid\Uuid;
use Symfony\Component\HttpFoundation\Response;
use App\FoodProduct\Exception\FoodProductNotFoundException;
use App\FoodProduct\Repository\FoodProductRepositoryInterface;

class DeleteUseCase
{
    public function __construct(private FoodProductRepositoryInterface $foodProductRepository)
    {
    }

    public function execute(string $id, Uuid $userId): void
    {
        $foodProduct = $this->foodProductRepository->getByFoodProductIdUserId(new Uuid($id), $userId);

        if (!$foodProduct)
            throw new FoodProductNotFoundException('FoodProduct dont found', Response::HTTP_NOT_FOUND);
        $this->foodProductRepository->remove($foodProduct);
    }
}
