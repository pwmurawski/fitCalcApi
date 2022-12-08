<?php

declare(strict_types=1);

namespace App\SelectedProduct\UseCase;

use App\SelectedProduct\Repository\SelectedProductRepositoryInterface;
use Symfony\Component\Uid\Uuid;

class GetUseCase
{
    public function __construct(private SelectedProductRepositoryInterface $selectedProductRepository)
    {
    }

    public function execute(string $id)
    {
        return $this->selectedProductRepository->getById(new Uuid($id));
    }
}
