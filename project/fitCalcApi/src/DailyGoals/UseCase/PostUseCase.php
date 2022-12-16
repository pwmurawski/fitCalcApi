<?php

declare(strict_types=1);

namespace App\DailyGoals\UseCase;

use App\DailyGoals\DTO\DailyGoals;
use App\DailyGoals\Factory\DailyGoalsFactoryInterface;
use App\DailyGoals\Repository\DailyGoalsRepositoryInterface;
use DateTime;

class PostUseCase
{
    public function __construct(
        private DailyGoalsFactoryInterface $dailyGoalsFactory,
        private DailyGoalsRepositoryInterface $dailyGoalsRepository
    ) {
    }

    public function execute(DailyGoals $dailyGoalsData): void
    {
        $dailyGoals = $this->dailyGoalsFactory->create(
            $dailyGoalsData->getId(),
            $dailyGoalsData->getUserId(),
            $dailyGoalsData->getKcal(),
            $dailyGoalsData->getProtein(),
            $dailyGoalsData->getFat(),
            $dailyGoalsData->getCarbs(),
            new DateTime(),
        );

        $this->dailyGoalsRepository->save($dailyGoals);
    }
}
