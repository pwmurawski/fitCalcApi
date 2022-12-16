<?php

declare(strict_types=1);

namespace App\DailyGoals\Controller;

use Symfony\Component\Uid\Uuid;
use App\DailyGoals\Form\PostType;
use App\DailyGoals\UseCase\PostUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
     * @Route("/api/dailyGoals", name="dailyGoals.post", methods={"POST"})
     */
    public function __invoke(Request $request): View
    {
        $dailyGoalsId = Uuid::v4();

        $form = $this->formFactory->createNamed('dailyGoals', PostType::class, null, [
            'dailyGoalsId' => $dailyGoalsId,
            'userId' => $this->getUser()->getId(),
        ]);
        $form->submit($request->request->all());

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->view($form, Response::HTTP_BAD_REQUEST);
        }

        $this->postUseCase->execute($form->getData());

        return $this->view([
            'data' => ['id' => $dailyGoalsId],
        ], Response::HTTP_OK);
    }
}
