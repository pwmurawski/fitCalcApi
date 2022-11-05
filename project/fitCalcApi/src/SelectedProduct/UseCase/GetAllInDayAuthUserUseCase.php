<?php

declare(strict_types=1);

namespace App\SelectedProduct\UseCase;

use App\SelectedProduct\Repository\SelectedProductRepositoryInterface;
use DateTime;
use Symfony\Component\Uid\Uuid;

class GetAllInDayAuthUserUseCase
{
    public function __construct(private SelectedProductRepositoryInterface $selectedProductRepository)
    {
    }

    public function execute(string $date, Uuid $userId): array
    {
        return $this->selectedProductRepository->getByDateUserId(new DateTime($date), $userId);
    }
}
