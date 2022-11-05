<?php

declare(strict_types=1);

namespace App\FoodProduct\Controller;

use FOS\RestBundle\View\View;
use App\FoodProduct\UseCase\DeleteUseCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use App\FoodProduct\Exception\FoodProductNotFoundException;

class Delete extends AbstractFOSRestController
{
    public function __construct(private DeleteUseCase $deleteUseCase)
    {
    }

    /**
     * @Route("/api/foodProduct/{id}", name="foodProduct.delete", methods={"DELETE"})
     */
    public function __invoke(string $id): View
    {
        try {
            $this->deleteUseCase->execute($id, $this->getUser()->getId());
            return $this->view([], Response::HTTP_NO_CONTENT);
        } catch (FoodProductNotFoundException $e) {
            return $this->view($e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }
}
