<?php

declare(strict_types=1);

namespace App\SelectedProduct\Controller;

use App\SelectedProduct\UseCase\GetUseCase;
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
     * @Route("/api/selectedProduct/{id}", name="selectedProduct.get", methods={"GET"})
     */
    public function __invoke(string $id): View
    {
        $selectedProduct = $this->getUseCase->execute($id);

        if (!$selectedProduct)
            return $this->view([], Response::HTTP_NOT_FOUND);
        return $this->view(['data' => $selectedProduct], Response::HTTP_OK);
    }
}
