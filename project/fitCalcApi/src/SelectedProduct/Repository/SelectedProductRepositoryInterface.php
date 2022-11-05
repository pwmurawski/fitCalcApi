<?php

declare(strict_types=1);

namespace App\SelectedProduct\Repository;

use Symfony\Component\Uid\Uuid;
use App\SelectedProduct\Entity\SelectedProduct;
use DateTimeInterface;

interface SelectedProductRepositoryInterface
{
    public function save(SelectedProduct $selectedProduct): void;
    public function remove(SelectedProduct $selectedProduct): void;
    public function getById(Uuid $id): ?SelectedProduct;
    public function getByDateUserId(DateTimeInterface $date, Uuid $userId): array;
    public function getByIdUserId(Uuid $id, Uuid $userId): ?SelectedProduct;
}
