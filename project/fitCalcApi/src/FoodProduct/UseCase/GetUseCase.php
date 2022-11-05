<?php

declare(strict_types=1);

namespace App\FoodProduct\UseCase;

use App\FoodProduct\Repository\FoodProductRepositoryInterface;
use Symfony\Component\Uid\Uuid;

class GetUseCase
{
    public function __construct(private FoodProductRepositoryInterface $foodProductRepository)
    {
    }

    public function execute(string $id)
    {
        return $this->foodProductRepository->getById(new Uuid($id));
    }
}
