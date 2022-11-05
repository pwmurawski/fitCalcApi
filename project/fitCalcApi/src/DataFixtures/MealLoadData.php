<?php

namespace App\DataFixtures;

use Doctrine\Persistence\ObjectManager;
use App\Meal\Factory\MealFactoryInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Uid\Uuid;

class MealLoadData extends Fixture
{
    public const MEALS_DATA = [
        [
            'id' => '22200000-0000-474c-b092-b0dd880c07e1',
            'name' => 'Śniadanie',
        ],
        [
            'id' => '22200000-0000-474c-b092-b0dd880c07e2',
            'name' => 'II Śniadanie',
        ],
        [
            'id' => '22200000-0000-474c-b092-b0dd880c07e3',
            'name' => 'Obiad',
        ],
        [
            'id' => '22200000-0000-474c-b092-b0dd880c07e4',
            'name' => 'Przekąska',
        ],
        [
            'id' => '22200000-0000-474c-b092-b0dd880c07e5',
            'name' => 'Kolacja',
        ],
    ];

    public function __construct(private MealFactoryInterface $mealFactory)
    {
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::MEALS_DATA as $mealData) {
            $meal = $this->mealFactory->create(new Uuid($mealData['id']), $mealData['name']);

            $manager->persist($meal);
            $manager->flush();
        }
    }
}
