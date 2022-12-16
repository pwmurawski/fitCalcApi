<?php

namespace App\DataFixtures;

use Symfony\Component\Uid\Uuid;
use App\DataFixtures\UserLoadData;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\DailyGoals\Factory\DailyGoalsFactoryInterface;
use DateTime;

class DailyGoalsLoadData extends Fixture
{
    public const DAILY_GOALS_DATA = [
        'id' => '22210000-1000-474c-b092-b0dd880c07e1',
        'userId' => UserLoadData::USER_ID,
        'kcal' => 2600,
        'protein' => 163,
        'fat' => 72,
        'carbs' => 325,
    ];

    public function __construct(private DailyGoalsFactoryInterface $dailyGoalslFactory)
    {
    }

    public function load(ObjectManager $manager): void
    {

        $dailyGoals = $this->dailyGoalslFactory->create(
            new Uuid(self::DAILY_GOALS_DATA['id']),
            new Uuid(self::DAILY_GOALS_DATA['userId']),
            self::DAILY_GOALS_DATA['kcal'],
            self::DAILY_GOALS_DATA['protein'],
            self::DAILY_GOALS_DATA['fat'],
            self::DAILY_GOALS_DATA['carbs'],
            new DateTime(),
        );

        $manager->persist($dailyGoals);
        $manager->flush();
    }
}
