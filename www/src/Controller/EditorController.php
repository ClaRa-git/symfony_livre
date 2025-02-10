<?php

namespace App\Controller;

use App\Entity\Editor;
use App\Form\EditorType;
use App\Repository\EditorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('admin/editor')]
final class EditorController extends AbstractController
{
    /**
     * Méthode permettant d'afficher la liste des éditeurs
     * @Route("/", name="app_editor_index", methods={"GET"})
     * @param EditorRepository $editorRepository
     * @return Response
     */
    #[Route(name: 'app_editor_index', methods: ['GET'])]
    public function index(EditorRepository $editorRepository): Response
    {
        return $this->render('editor/index.html.twig', [
            'editors' => $editorRepository->findAll(),
        ]);
    }

    /**
     * Méthode permettant de créer un nouvel éditeur
     * @Route("/new", name="app_editor_new", methods={"GET", "POST"})
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/new', name: 'app_editor_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $editor = new Editor();
        $form = $this->createForm(EditorType::class, $editor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($editor);
            $entityManager->flush();

            return $this->redirectToRoute('app_editor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('editor/new.html.twig', [
            'editor' => $editor,
            'form' => $form,
        ]);
    }

    /**
     * Méthode permettant d'afficher un éditeur
     * @Route("/{id}", name="app_editor_show", methods={"GET"})
     * @param Editor $editor
     * @return Response
     */
    #[Route('/{id}', name: 'app_editor_show', methods: ['GET'])]
    public function show(Editor $editor): Response
    {
        return $this->render('editor/show.html.twig', [
            'editor' => $editor,
        ]);
    }

    /**
     * Méthode permettant de modifier un éditeur
     * @Route("/{id}/edit", name="app_editor_edit", methods={"GET", "POST"})
     * @param Request $request
     * @param Editor $editor
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/{id}/edit', name: 'app_editor_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Editor $editor, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EditorType::class, $editor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_editor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('editor/edit.html.twig', [
            'editor' => $editor,
            'form' => $form,
        ]);
    }

    /**
     * Méthode permettant de supprimer un éditeur
     * @Route("/{id}", name="app_editor_delete", methods={"POST"})
     * @param Request $request
     * @param Editor $editor
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/{id}', name: 'app_editor_delete', methods: ['POST'])]
    public function delete(Request $request, Editor $editor, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$editor->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($editor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_editor_index', [], Response::HTTP_SEE_OTHER);
    }
}
