<?php

declare(strict_types=1);

namespace App\User\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;

class GetUserIdAuth extends AbstractFOSRestController
{
    public function __construct()
    {
    }

    /**
     * @Route("/api/userId", name="user.userId", methods={"GET"})
     */
    public function __invoke(): View
    {
        return $this->view([
            "data" => ["userId" => $this->getUser()->getId()]
        ], Response::HTTP_OK);
    }
}
