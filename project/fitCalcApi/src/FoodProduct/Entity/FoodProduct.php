<?php

declare(strict_types=1);

namespace App\FoodProduct\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use App\FoodProduct\Repository\FoodProductRepository;

/**
 * @ORM\Entity(repositoryClass=FoodProductRepository::class)
 * @ORM\Table(name="`foodProduct`")
 */
class FoodProduct
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
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @ORM\Column(type="float")
     */
    private float $kcal;

    /**
     * @ORM\Column(type="float")
     */
    private float $protein;

    /**
     * @ORM\Column(type="float")
     */
    private float $fat;

    /**
     * @ORM\Column(type="float")
     */
    private float $carbs;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private ?string $code;

    public function __construct(
        Uuid $id,
        Uuid $userId,
        string $name,
        float $kcal,
        float $protein,
        float $fat,
        float $carbs,
        ?string $code = null
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->name = $name;
        $this->kcal = $kcal;
        $this->protein = $protein;
        $this->fat = $fat;
        $this->carbs = $carbs;
        $this->code = $code;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getUserId(): Uuid
    {
        return $this->userId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getKcal(): float
    {
        return $this->kcal;
    }

    public function getProtein(): float
    {
        return $this->protein;
    }

    public function getFat(): float
    {
        return $this->fat;
    }

    public function getCarbs(): float
    {
        return $this->carbs;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setKcal(float $kcal): void
    {
        $this->kcal = $kcal;
    }

    public function setProtein(float $protein): void
    {
        $this->protein = $protein;
    }

    public function setFat(float $fat): void
    {
        $this->fat = $fat;
    }

    public function setCarbs(float $carbs): void
    {
        $this->carbs = $carbs;
    }

    public function setCode(?string $code): void
    {
        $this->code = $code;
    }
}
