<?php

declare(strict_types=1);

namespace App\SelectedProduct\Controller;

use Symfony\Component\Uid\Uuid;
use App\SelectedProduct\Form\PostType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\SelectedProduct\UseCase\PostUseCase;
use Symfony\Component\Form\FormFactoryInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;

class Post extends AbstractFOSRestController
{
    public function __construct(
        private FormFactoryInterface $formFactory,
        private PostUseCase $postUseCase
    ) {
    }

    /**
     * @Route("/api/selectedProduct", name="selectedProduct.post", methods={"POST"})
     */
    public function __invoke(Request $request): View
    {
        $id = Uuid::v4();

        $form = $this->formFactory->createNamed('selectedProduct', PostType::class, null, [
            'id' => $id,
            'userId' => $this->getUser()->getId(),
        ]);
        $form->submit($request->request->all());

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->view($form, Response::HTTP_BAD_REQUEST);
        }

        $this->postUseCase->execute($form->getData());

        return $this->view([
            'id' => $id,
        ], Response::HTTP_OK);
    }
}
