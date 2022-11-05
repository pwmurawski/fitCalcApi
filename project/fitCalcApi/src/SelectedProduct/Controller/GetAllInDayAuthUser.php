<?php

declare(strict_types=1);

namespace App\SelectedProduct\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use App\SelectedProduct\UseCase\GetAllInDayAuthUserUseCase;
use FOS\RestBundle\View\View;

class GetAllInDayAuthUser extends AbstractFOSRestController
{
    public function __construct(private GetAllInDayAuthUserUseCase $getAllInDayAuthUserUseCase)
    {
    }

    /**
     * @Route("/api/selectedProduct/day/{date}", name="selectedProduct.get.day", methods={"GET"})
     */
    public function __invoke(string $date): View
    {
        $selectedProducts = $this->getAllInDayAuthUserUseCase->execute($date, $this->getUser()->getId());
        return $this->view(['data' => $selectedProducts], Response::HTTP_OK);
    }
}
