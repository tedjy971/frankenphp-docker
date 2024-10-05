<?php

namespace Infrastructure\Symfony\Controller;

use Application\DTO\User\NoteCreateDTO;
use Application\UseCase\User\CreateNoteUseCase;
use Application\UseCase\User\RegisterUserUseCase;
use Doctrine\ORM\EntityManagerInterface;
use Infrastructure\Symfony\Entity\User as DoctrineUser;
use Infrastructure\Symfony\Form\User\RegistrationFormType;
use Infrastructure\Symfony\Repository\Doctrine\UserRepository;
use Infrastructure\Symfony\Security\EmailVerifier;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController {
  public function __construct(private EmailVerifier $emailVerifier) {
  }

  #[Route('/register', name: 'app_register')]
  public function register(Request $request, RegisterUserUseCase $createUserUseCase): Response {
    $userDTO = new NoteCreateDTO();
    $form = $this->createForm(RegistrationFormType::class, $userDTO);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $createUserUseCase->execute($userDTO);
      return $this->redirectToRoute('user_list');
    }

    return $this->render('registration/register.html.twig', [
      'registrationForm' => $form,
    ]);
  }

  #[Route('/verify/email', name: 'app_verify_email')]
  public function verifyUserEmail(Request $request, UserRepository $userRepository): Response {
    $id = $request->query->get('id');

    if (null === $id) {
      return $this->redirectToRoute('app_register');
    }

    $user = $userRepository->find($id);

    if (null === $user) {
      return $this->redirectToRoute('app_register');
    }

    // validate email confirmation link, sets User::isVerified=true and persists
    try {
      $this->emailVerifier->handleEmailConfirmation($request, $user);
    }
    catch (VerifyEmailExceptionInterface $exception) {
      $this->addFlash('verify_email_error', $exception->getReason());

      return $this->redirectToRoute('app_register');
    }

    // @TODO Change the redirect on success and handle or remove the flash message in your templates
    $this->addFlash('success', 'Your email address has been verified.');

    return $this->redirectToRoute('app_register');
  }
}
