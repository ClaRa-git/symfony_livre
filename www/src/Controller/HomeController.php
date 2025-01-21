<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use App\Repository\SerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(SerieRepository $serieRepository): Response
    {
        // Déclaration du titre de la page
        $title = "Toutes nos séries";

        // Récupération des séries
        $allSeries = $serieRepository->findAll();

        $series = [];
        foreach ($allSeries as $serie) {
            $series[] = [
                'serie' => $serie,
                'imagePath' => $serieRepository->getFistBookCover($serie->getId())
            ];
        }

        return $this->render('home/index.html.twig', [
            'title' => $title,
            'series' => $series
        ]);
    }

    /**
     * Méthode permettant d'afficher la série en entier
     * @Route("/detail/serie/{id}", name="app_detail_serie")
     * @param SerieRepository $serieRepository
     * @param BookRepository $bookRepository
     * @param int $id
     * @return Response
     */
    #[Route('/detail/serie/{id}', name: 'app_detail_serie')]
    public function detailSerie(SerieRepository $serieRepository, BookRepository $bookRepository, int $id)
    {
        // Récupération de la série
        $serie = $serieRepository->find($id);

        // Titre de la page
        $title = "Détail de la série : " . $serie->getTitle();

        // Récupération des livres de la série
        $books = $bookRepository->findAllForSerie($id);

        return $this->render('home/detail_serie.html.twig', [
            'title' => $title,
            'serie' => $serie,
            'books' => $books
        ]);
    }

    /**
     * Méthode pour afficher le détail d'un livre
     * @Route("/detail/book/{id}", name="app_detail_book")
     * @param BookRepository $bookRepository
     * @param SerieRepository $serieRepository
     * @param int $id
     * @return Response 
     */
    #[Route('/detail/book/{id}', name: 'app_detail_book')]
    public function detailBook(BookRepository $bookRepository, SerieRepository $serieRepository, int $id)
    {
        // Récupération du livre
        $book = $bookRepository->getSerieByBook($id)[0];

        $authors = $serieRepository->getAuthorForSerie($book->getSerie()->getId());

        $editors = $serieRepository->getEditorForSerie($book->getSerie()->getId());

        $types = $serieRepository->getTypesForSerie($book->getSerie()->getId());

        // Titre de la page
        $title = $book->getTitle();

        return $this->render('home/detail_book.html.twig', [
            'title' => $title,
            'book' => $book,
            'authors' => $authors,
            'editors' => $editors,
            'types' => $types
        ]);
    }

    /**
     * Méthode pour afficher les séries par auteur
     * @Route("/series/author/{id}", name="app_series_author")
     * @param SerieRepository $serieRepository
     * @return Response
     */
    #[Route('/series/author/{id}', name: 'app_series_author')]
    public function seriesAuthor(SerieRepository $serieRepository, int $id)
    {
        //Récupération des datas des série par auteur
        $allSeries = $serieRepository->getSeriesByAuthor($id);

        $series = [];
        foreach ($allSeries as $serie) {
            $series[] = [
                'serie' => $serie,
                'imagePath' => $serieRepository->getFistBookCover($serie['id'])
            ];
        }

        // Titre de la page
        $title = "Séries de " . $series[0]['serie']['firstname'] . " " . $series[0]['serie']['name'];

        return $this->render('home/index.html.twig', [
            'title' => $title,
            'series' => $series
        ]);
    }

    /**
     * Méthode pour afficher les séries par éditeur
     * @Route("/series/editor/{id}", name="app_series_editor")
     * @param SerieRepository $serieRepository
     * @return Response
     */
    #[Route('/series/editor/{id}', name: 'app_series_editor')]
    public function seriesEditor(SerieRepository $serieRepository, int $id)
    {
        //Récupération des datas des série par éditeur
        $allSeries = $serieRepository->getSeriesByEditor($id);

        $series = [];
        foreach ($allSeries as $serie) {
            $series[] = [
                'serie' => $serie,
                'imagePath' => $serieRepository->getFistBookCover($serie['id'])
            ];
        }

        // Titre de la page
        $title = "Séries de " . $series[0]['serie']['name'];

        return $this->render('home/index.html.twig', [
            'title' => $title,
            'series' => $series
        ]);
    }

}
