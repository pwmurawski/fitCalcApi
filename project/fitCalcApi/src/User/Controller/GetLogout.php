<?php

declare(strict_types=1);

namespace App\User\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;

class GetLogout extends AbstractFOSRestController
{
    public function __construct()
    {
    }

    /**
     * @Route("/api/logout", name="user.logout", methods={"GET"})
     */
    public function __invoke(): View
    {
        setcookie('BEARER', '', time() - 3600, '/', $_ENV['DOMAIN'], true, true);
        return $this->view(null, Response::HTTP_NO_CONTENT);
    }
}
