<?php

declare(strict_types=1);

namespace App\DailyGoals\Repository;

use Symfony\Component\Uid\Uuid;
use App\DailyGoals\Entity\DailyGoals;
use DateTimeInterface;

interface DailyGoalsRepositoryInterface
{
    public function save(DailyGoals $DailyGoals): void;
    public function remove(DailyGoals $DailyGoals): void;
    public function getByName(string $name): ?DailyGoals;
    public function getById(Uuid $id): ?DailyGoals;
    public function getAll(): array;
    public function getByDailyGoalsIdUserId(Uuid $id, Uuid $userId): ?DailyGoals;
    public function getByDateUserId(DateTimeInterface $date, Uuid $userId);
}
