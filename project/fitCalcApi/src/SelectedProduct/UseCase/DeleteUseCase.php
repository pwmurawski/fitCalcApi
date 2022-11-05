<?php

declare(strict_types=1);

namespace App\SelectedProduct\UseCase;

use Symfony\Component\Uid\Uuid;
use Symfony\Component\HttpFoundation\Response;
use App\SelectedProduct\Exception\SelectedProductNotFoundException;
use App\SelectedProduct\Repository\SelectedProductRepositoryInterface;

class DeleteUseCase
{
    public function __construct(private SelectedProductRepositoryInterface $selectedProductRepository)
    {
    }

    public function execute(string $id, Uuid $userId): void
    {
        $selectedProduct = $this->selectedProductRepository->getByIdUserId(new Uuid($id), $userId);

        if (!$selectedProduct)
            throw new SelectedProductNotFoundException('SelectedProduct dont found', Response::HTTP_NOT_FOUND);
        $this->selectedProductRepository->remove($selectedProduct);
    }
}
