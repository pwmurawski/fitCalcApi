<?php

declare(strict_types=1);

namespace App\SelectedProduct\Controller;

use App\SelectedProduct\UseCase\DeleteUseCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use App\SelectedProduct\Exception\SelectedProductNotFoundException;
use FOS\RestBundle\View\View;

class Delete extends AbstractFOSRestController
{
    public function __construct(private DeleteUseCase $deleteUseCase)
    {
    }

    /**
     * @Route("/api/selectedProduct/{id}", name="selectedProduct.delete", methods={"DELETE"})
     */
    public function __invoke(string $id): View
    {
        try {
            $this->deleteUseCase->execute($id, $this->getUser()->getId());
            return $this->view([], Response::HTTP_NO_CONTENT);
        } catch (SelectedProductNotFoundException $e) {
            return $this->view($e->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }
}
