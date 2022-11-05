<?php

declare(strict_types=1);

namespace App\FoodProduct\Controller;

use App\FoodProduct\UseCase\GetAllUseCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;

class GetAll extends AbstractFOSRestController
{
    public function __construct(private GetAllUseCase $getAllUseCase)
    {
    }

    /**
     * @Route("/api/foodProducts", name="foodProduct.getAll", methods={"GET"})
     */
    public function __invoke(): View
    {
        $foodProductsData = $this->getAllUseCase->execute();
        return $this->view(['data' => $foodProductsData], Response::HTTP_OK);
    }
}
