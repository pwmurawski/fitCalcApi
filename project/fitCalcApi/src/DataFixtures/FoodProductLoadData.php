<?php

namespace App\DataFixtures;

use Symfony\Component\Uid\Uuid;
use App\DataFixtures\UserLoadData;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\FoodProduct\Factory\FoodProductFactoryInterface;

class FoodProductLoadData extends Fixture
{
    public const FOOD_PRODUCT_DATA = [
        [
            'id' => '22200000-1000-474c-b092-b0dd880c07e1',
            'userId' => UserLoadData::USER_ID,
            'name' => 'Mleko 2.0%',
            'kcal' => 49,
            'protein' => 3,
            'fat' => 2,
            'carbs' => 4.7,
            'code' => '5900512850023'
        ],
        [
            'id' => '22200000-2000-474c-b092-b0dd880c07e1',
            'userId' => UserLoadData::USER_ID,
            'name' => 'Pizza z kurczakiem',
            'kcal' => 233,
            'protein' => 14.6,
            'fat' => 6.9,
            'carbs' => 26.7,
            'code' => '8410762861023'
        ],
        [
            'id' => '22200000-3000-474c-b092-b0dd880c07e1',
            'userId' => UserLoadData::USER_ID,
            'name' => 'Chleb',
            'kcal' => 255,
            'protein' => 6.5,
            'fat' => 1.3,
            'carbs' => 56.3
        ],
    ];

    public function __construct(private FoodProductFactoryInterface $mealFactory)
    {
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::FOOD_PRODUCT_DATA as $foodProductData) {
            $foodProduct = $this->mealFactory->create(
                new Uuid($foodProductData['id']),
                new Uuid($foodProductData['userId']),
                $foodProductData['name'],
                $foodProductData['kcal'],
                $foodProductData['protein'],
                $foodProductData['fat'],
                $foodProductData['carbs'],
                $foodProductData['code'] ?? null,
            );

            $manager->persist($foodProduct);
            $manager->flush();
        }
    }
}
