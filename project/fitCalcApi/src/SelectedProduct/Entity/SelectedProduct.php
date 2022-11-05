<?php

declare(strict_types=1);

namespace App\SelectedProduct\Entity;

use App\FoodProduct\Entity\FoodProduct;
use App\Meal\Entity\Meal;
use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping as ORM;
use App\SelectedProduct\Repository\SelectedProductRepository;
use DateTimeInterface;

/**
 * @ORM\Entity(repositoryClass=SelectedProductRepository::class)
 * @ORM\Table(name="`selectedProduct`")
 */
class SelectedProduct
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique="true")
     */
    private Uuid $id;

    /**
     * @ORM\Column(type="uuid")
     */
    private Uuid $userId;

    /**
     * @ORM\ManyToOne(targetEntity=Meal::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private Meal $meal;

    /**
     * @ORM\ManyToOne(targetEntity=FoodProduct::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private FoodProduct $foodProduct;

    /**
     * @ORM\Column(type="float")
     */
    private float $weight;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $dateTime;

    public function __construct(
        Uuid $id,
        Uuid $userId,
        Meal $meal,
        FoodProduct $foodProduct,
        float $weight,
        DateTimeInterface $dateTime,
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->meal = $meal;
        $this->foodProduct = $foodProduct;
        $this->weight = $weight;
        $this->dateTime = $dateTime;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getUserId(): Uuid
    {
        return $this->userId;
    }

    public function getMeal(): Meal
    {
        return $this->meal;
    }

    public function getFoodProduct(): FoodProduct
    {
        return $this->foodProduct;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function getDateTime(): DateTimeInterface
    {
        return $this->dateTime;
    }

    public function setWeight(float $weight): void
    {
        $this->weight = $weight;
    }
}
