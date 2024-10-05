<?php

namespace Infrastructure\Symfony\Controller;

use Application\DTO\Note\NoteCreateDTO;
use Application\DTO\Note\NoteUpdateDTO;
use Application\UseCase\Note\CreateNoteUseCase;
use Application\UseCase\Note\UpdateNoteUseCase;
use Doctrine\ORM\EntityManagerInterface;
use Domain\Repository\UserRepositoryInterface;
use Infrastructure\Symfony\Entity\Note;
use Infrastructure\Symfony\Form\NoteType;
use Infrastructure\Symfony\Repository\Doctrine\NoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/note')]
final class NoteController extends AbstractController {
  #[Route(name: 'app_note_index', methods: ['GET'])]
  public function index(NoteRepository $noteRepository): Response {
    $noteCollection= $noteRepository->findAll();

    return $this->render('note/index.html.twig', [
      'notes' => $noteCollection,
    ]);
  }

  #[Route('/new', name: 'app_note_new', methods: ['GET', 'POST'])]
  public function new(Request $request, CreateNoteUseCase $createNoteUseCase, UserRepositoryInterface $userRepository): Response {
    $noteCreateDTO = new NoteCreateDTO();
    $domainUser = $userRepository->_findById($this->getUser()->getId());

    $form = $this->createForm(NoteType::class, $noteCreateDTO);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $createNoteUseCase->execute($noteCreateDTO, $domainUser);

      return $this->redirectToRoute('app_note_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->render('note/new.html.twig', [
      'note' => $noteCreateDTO,
      'form' => $form,
    ]);
  }

  #[Route('/{id}', name: 'app_note_show', methods: ['GET'])]
  public function show(Note $note): Response {
    return $this->render('note/show.html.twig', [
      'note' => $note,
    ]);
  }

  #[Route('/{id}/edit', name: 'app_note_edit', methods: ['GET', 'POST'])]
  public function edit(Request $request, Note $note, UpdateNoteUseCase $noteUseCase): Response {

    $noteUpdateDTO = new NoteUpdateDTO();

    $object  = $note->toObject(NoteCreateDTO::class);
    dd($object);

//    $noteUpdateDTO->id = $note->getId();
//    $noteUpdateDTO->title = $note->getTitle();
//    $noteUpdateDTO->content = $note->getContent();

    $form = $this->createForm(NoteType::class, $noteUpdateDTO);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $noteUseCase->execute($noteUpdateDTO);

      return $this->redirectToRoute('app_note_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->render('note/edit.html.twig', [
      'note' => $note,
      'form' => $form,
    ]);
  }

  #[Route('/{id}', name: 'app_note_delete', methods: ['POST'])]
  public function delete(Request $request, Note $note, EntityManagerInterface $entityManager): Response {
    if ($this->isCsrfTokenValid('delete' . $note->getId(), $request->getPayload()->getString('_token'))) {
      $entityManager->remove($note);
      $entityManager->flush();
    }

    return $this->redirectToRoute('app_note_index', [], Response::HTTP_SEE_OTHER);
  }
}
