<?php

declare(strict_types=1);

namespace App\Meal\Controller;

use FOS\RestBundle\View\View;
use App\Meal\UseCase\GetAllUseCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;

class GetAll extends AbstractFOSRestController
{
    public function __construct(private GetAllUseCase $getAllUseCase)
    {
    }

    /**
     * @Route("/api/meals", name="meal.getAll", methods={"GET"})
     */
    public function __invoke(): View
    {
        $meals = $this->getAllUseCase->execute();
        return $this->view(['data' => $meals], Response::HTTP_OK);
    }
}
