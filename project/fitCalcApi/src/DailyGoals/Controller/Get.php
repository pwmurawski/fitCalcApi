<?php

declare(strict_types=1);

namespace App\DailyGoals\Controller;

use App\DailyGoals\UseCase\GetUseCase;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\View\View;

class Get extends AbstractFOSRestController
{
    public function __construct(private GetUseCase $getUseCase)
    {
    }

    /**
     * @Route("/api/dailyGoals/{date}", name="dailyGoals.get", methods={"GET"})
     */
    public function __invoke(string $date): View
    {
        $dailyGoalsData = $this->getUseCase->execute($date, $this->getUser()->getId());

        if (!$dailyGoalsData)
            return $this->view([], Response::HTTP_NOT_FOUND);
        return $this->view(['data' => $dailyGoalsData], Response::HTTP_OK);
    }
}
