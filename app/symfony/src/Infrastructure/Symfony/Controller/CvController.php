<?php

namespace Infrastructure\Symfony\Controller;

use Application\DTO\Cv\CvCreateDTO;
use Application\UseCase\Cv\CreateCvUseCase;
use Domain\Model\CV;
use Infrastructure\Symfony\Form\Cv\CvFormFlow;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CvController extends AbstractController {
    private CreateCVUseCase $createCVUseCase;

    public function __construct(CreateCVUseCase $createCVUseCase) {
        $this->createCVUseCase = $createCVUseCase;
    }

    #[Route('/cv/create', name: 'cv_create')]
    public function create(Request $request, CVFormFlow $flow): Response {
        $cv = new CvCreateDTO();
        $flow->bind($cv);

        $form = $flow->createForm();
        if ($flow->isValid($form)) {
            $flow->saveCurrentStepData($form);

            if ($flow->nextStep()) {
                $form = $flow->createForm();
            }
            else {
                $this->createCVUseCase->execute($cv);
                $flow->reset();

                return $this->redirectToRoute('cv_success');
            }
        }

        return $this->render('cv/new.html.twig', [
            'form' => $form->createView(),
            'flow' => $flow,
        ]);
    }

    #[Route('/cv/success', name: 'cv_success')]
    public function success(): Response {
        return $this->render('cv/success.html.twig');
    }

}
