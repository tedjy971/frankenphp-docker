<?php

namespace Infrastructure\Symfony\Controller;

use Application\UseCase\User\GetAllUserUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user', name: 'app_user_')]
class UserController extends AbstractController{

    #[Route('/', name: 'list')]
    public function list(GetAllUserUseCase $useCase): Response
    {
        $users = $useCase->execute();

        return $this->render('user/list.html.twig', [
            'users' => $users,
        ]);
    }
}
