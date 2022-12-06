<?php

declare(strict_types=1);

namespace App\FoodProduct\Controller;

use App\FoodProduct\UseCase\GetUseCase;
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
     * @Route("/api/foodProducts/{id}", name="foodProduct.get", methods={"GET"})
     */
    public function __invoke(string $id): View
    {
        $foodProductData = $this->getUseCase->execute($id);

        if (!$foodProductData)
            return $this->view([], Response::HTTP_NOT_FOUND);
        return $this->view(['data' => $foodProductData], Response::HTTP_OK);
    }
}
