<?php

declare(strict_types=1);

namespace App\User\UseCase;

use App\User\DTO\CreateUser;
use App\User\Factory\UserFactoryInterface;
use App\User\Repository\UserRepositoryInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\DailyGoals\Factory\DailyGoalsFactoryInterface;
use App\DailyGoals\Repository\DailyGoalsRepositoryInterface;
use DateTime;
use App\DataFixtures\DailyGoalsLoadData;
use Symfony\Component\Uid\UuidV4;

class RegisterUserUseCase
{
    public function __construct(
        private UserFactoryInterface $userFactory,
        private UserRepositoryInterface $userRepository,
        private UserPasswordHasherInterface $hasher,
        private DailyGoalsFactoryInterface $dailyGoalsFactory,
        private DailyGoalsRepositoryInterface $dailyGoalsRepository
    ) {
    }

    public function execute(CreateUser $userData): void
    {
        $user = $this->userFactory->create($userData->getId(), $userData->getEmail(), $userData->getPassword());
        $user->setPassword(
            $this->hasher->hashPassword(
                $user,
                $user->getPassword(),
            )
        );

        $dailyGoals = $this->dailyGoalsFactory->create(
            new UuidV4(),
            $userData->getId(),
            DailyGoalsLoadData::DAILY_GOALS_DATA['kcal'],
            DailyGoalsLoadData::DAILY_GOALS_DATA['protein'],
            DailyGoalsLoadData::DAILY_GOALS_DATA['fat'],
            DailyGoalsLoadData::DAILY_GOALS_DATA['carbs'],
            new DateTime(),
        );

        $this->userRepository->save($user);
        $this->dailyGoalsRepository->save($dailyGoals);
    }
}
