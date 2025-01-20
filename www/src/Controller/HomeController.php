<?php

namespace App\Controller;

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
        $series = $serieRepository->findAll();

        return $this->render('home/index.html.twig', [
            'title' => $title,
            'series' => $series
        ]);
    }
}
