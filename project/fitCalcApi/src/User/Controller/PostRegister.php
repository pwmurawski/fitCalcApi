<?php

declare(strict_types=1);

namespace App\User\Controller;

use Symfony\Component\Uid\Uuid;
use App\User\Form\RegisterUserType;
use App\User\UseCase\RegisterUserUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormFactoryInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;

final class PostRegister extends AbstractFOSRestController
{
    public function __construct(
        private FormFactoryInterface $formFactory,
        private RegisterUserUseCase $registerUserUseCase,
    ) {
    }

    /**
     * @Route("/api/register", name="user.register", methods={"POST"})
     */
    public function __invoke(Request $request): View
    {
        $userId = Uuid::v4();

        $form = $this->formFactory->createNamed('user', RegisterUserType::class, null, ['userId' => $userId]);
        $form->submit($request->request->all());

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->view($form, Response::HTTP_BAD_REQUEST);
        }

        $this->registerUserUseCase->execute($form->getData());

        return $this->view([
            'data' => [
                'id' => $userId,
            ]
        ], Response::HTTP_OK);
    }
}
