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
            'name' => 'Mleko',
            'kcal' => 260,
            'protein' => 10,
            'fat' => 30,
            'carbs' => 300,
            'code' => '908953'
        ],
        [
            'id' => '22200000-2000-474c-b092-b0dd880c07e1',
            'userId' => UserLoadData::USER_ID,
            'name' => "Pizza",
            'kcal' => 1300,
            'protein' => 35,
            'fat' => 40,
            'carbs' => 450,
            'code' => '1231231312097'
        ],
        [
            'id' => '22200000-3000-474c-b092-b0dd880c07e1',
            'userId' => UserLoadData::USER_ID,
            'name' => 'Chleb',
            'kcal' => 260,
            'protein' => 10,
            'fat' => 10,
            'carbs' => 300
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
