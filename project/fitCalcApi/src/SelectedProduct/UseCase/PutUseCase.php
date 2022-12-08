<?php

declare(strict_types=1);

namespace App\SelectedProduct\UseCase;

use App\SelectedProduct\DTO\PutSelectedProduct;
use App\SelectedProduct\Exception\SelectedProductNotFoundException;
use App\SelectedProduct\Repository\SelectedProductRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;

class PutUseCase
{
    public function __construct(private SelectedProductRepositoryInterface $selectedProductRepository)
    {
    }

    public function execute(PutSelectedProduct $selectedProductData): void
    {
        $selectedProduct = $this->selectedProductRepository->getByIdUserId(
            $selectedProductData->getId(),
            $selectedProductData->getUserId(),
        );

        if (!$selectedProduct)
            throw new SelectedProductNotFoundException('Food Product not found', Response::HTTP_NOT_FOUND);

        $selectedProduct->setWeight($selectedProductData->getWeight());

        $this->selectedProductRepository->save($selectedProduct);
    }
}
