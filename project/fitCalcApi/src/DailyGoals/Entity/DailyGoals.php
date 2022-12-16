<?php

declare(strict_types=1);

namespace App\DailyGoals\Entity;

use Symfony\Component\Uid\Uuid;
use Doctrine\ORM\Mapping as ORM;
use App\DailyGoals\Repository\DailyGoalsRepository;
use DateTimeInterface;

/**
 * @ORM\Entity(repositoryClass=DailyGoalsRepository::class)
 * @ORM\Table(name="`dailyGoals`")
 */
class DailyGoals
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
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $date;

    public function __construct(
        Uuid $id,
        Uuid $userId,
        float $kcal,
        float $protein,
        float $fat,
        float $carbs,
        DateTimeInterface $date,
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->kcal = $kcal;
        $this->protein = $protein;
        $this->fat = $fat;
        $this->carbs = $carbs;
        $this->date = $date;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getUserId(): Uuid
    {
        return $this->userId;
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

    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }
}
