<?php

declare(strict_types=1);

namespace App\DailyGoals\UseCase;

use App\DailyGoals\Repository\DailyGoalsRepositoryInterface;
use DateTime;
use Symfony\Component\Uid\Uuid;

class GetUseCase
{
    public function __construct(private DailyGoalsRepositoryInterface $dailyGoalsRepository)
    {
    }

    public function execute(string $date, Uuid $userId)
    {
        return $this->dailyGoalsRepository->getByDateUserId(new DateTime($date), $userId);
    }
}
