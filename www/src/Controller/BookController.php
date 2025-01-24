<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('admin/book')]
final class BookController extends AbstractController
{
    /**
     * Méthode permettant d'afficher la liste des livres
     * @Route("/", name="app_book_index", methods={"GET"})
     * @param BookRepository $bookRepository
     * @return Response
     */
    #[Route(name: 'app_book_index', methods: ['GET'])]
    public function index(BookRepository $bookRepository): Response
    {
        return $this->render('book/index.html.twig', [
            'books' => $bookRepository->findAll(),
        ]);
    }

    /**
     * Méthode permettant de créer un nouveau livre
     * @Route("/new", name="app_book_new", methods={"GET", "POST"})
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/new', name: 'app_book_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($book);
            $entityManager->flush();

            return $this->redirectToRoute('app_book_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('book/new.html.twig', [
            'book' => $book,
            'form' => $form,
        ]);
    }

    /**
     * Méthode permettant d'afficher un livre
     * @Route("/{id}", name="app_book_show", methods={"GET"})
     * @param Book $book
     * @return Response
     */
    #[Route('/{id}', name: 'app_book_show', methods: ['GET'])]
    public function show(Book $book, SerieRepository $serieRepository): Response
    {
        // Récupération des auteurs, éditeurs et genres de la série
        $authors = $serieRepository->getAuthorForSerie($book->getSerie()->getId());
        $editors = $serieRepository->getEditorForSerie($book->getSerie()->getId());
        $types = $serieRepository->getTypesForSerie($book->getSerie()->getId());
        
        $title = $book->getTitle();

        return $this->render('book/show.html.twig', [
            'book' => $book,
            'title' => $title,
            'authors' => $authors,
            'editors' => $editors,
            'types' => $types
        ]);
    }

    /**
     * Méthode permettant de modifier un livre
     * @Route("/{id}/edit", name="app_book_edit", methods={"GET", "POST"})
     * @param Request $request
     * @param Book $book
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/{id}/edit', name: 'app_book_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Book $book, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_book_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('book/edit.html.twig', [
            'book' => $book,
            'form' => $form,
        ]);
    }

    /**
     * Méthode permettant de supprimer un livre
     * @Route("/{id}", name="app_book_delete", methods={"POST"})
     * @param Request $request
     * @param Book $book
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    #[Route('/{id}', name: 'app_book_delete', methods: ['POST'])]
    public function delete(Request $request, Book $book, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$book->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($book);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_book_index', [], Response::HTTP_SEE_OTHER);
    }
}
