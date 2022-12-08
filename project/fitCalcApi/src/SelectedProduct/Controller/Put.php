<?php

declare(strict_types=1);

namespace App\SelectedProduct\Controller;

use FOS\RestBundle\View\View;
use Symfony\Component\Uid\Uuid;
use App\SelectedProduct\Form\PutType;
use Symfony\Component\Form\FormError;
use App\SelectedProduct\UseCase\PutUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use App\SelectedProduct\Exception\SelectedProductNotFoundException;
use Symfony\Component\Form\FormFactoryInterface;

class Put extends AbstractFOSRestController
{
    public function __construct(
        private FormFactoryInterface $formFactory,
        private PutUseCase $putUseCase
    ) {
    }

    /**
     * @Route("/api/selectedProduct/{id}", name="selectedProduct.put", methods={"PUT"})
     */
    public function __invoke(string $id, Request $request): View
    {
        $userId = $this->getUser()->getId();

        $form = $this->formFactory->createNamed('putSelectedProduct', PutType::class, null, [
            'id' => new Uuid($id),
            'userId' => $userId,
        ]);
        $form->submit($request->request->all());

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->view($form, Response::HTTP_BAD_REQUEST);
        }

        try {
            $this->putUseCase->execute($form->getData());
            return $this->view(null, Response::HTTP_NO_CONTENT);
        } catch (SelectedProductNotFoundException $e) {
            $form->addError(new FormError($e->getMessage()));
            return $this->view($form, Response::HTTP_NOT_FOUND);
        }
    }
}
