<?php

declare(strict_types=1);

namespace App\DailyGoals\Factory;

use App\DailyGoals\Entity\DailyGoals;
use DateTimeInterface;
use Symfony\Component\Uid\Uuid;

interface DailyGoalsFactoryInterface
{
    public function create(
        Uuid $id,
        Uuid $userId,
        float $kcal,
        float $protein,
        float $fat,
        float $carbs,
        DateTimeInterface $date,
    ): DailyGoals;
}
