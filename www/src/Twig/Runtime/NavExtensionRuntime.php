<?php

namespace App\Twig\Runtime;

use App\Repository\SerieRepository;
use Twig\Extension\RuntimeExtensionInterface;

class NavExtensionRuntime implements RuntimeExtensionInterface
{
    // On déclare une variable en private pour stocker l'instance de SeriesRepository
    private $serieRepository;

    public function __construct(SerieRepository $serieRepository)
    {
        // On instancie SeriesRepository
        $this->serieRepository = $serieRepository;
    }

    /**
     * Méthode pour récupérer les séries par auteur
     * @return array
     */
    public function menuSeriesAuthor() : array
    {
        return $this->serieRepository->getCountSeriesByAuthor();
    }

    /**
     * Méthode pour récupérer les séries par éditeur
     * @return array
     */
    public function menuSeriesEditor() : array
    {
        return $this->serieRepository->getCountSeriesByEditor();
    }

    /**
     * Méthode de formatage des nombres pour les prix
     * @param int $number
     * @param int $decimals
     * @param string $thousandsSep
     * @param string $decPoint
     * @return string
     */
    public function numberFormat($number, $decimals = 2, $thousandsSep = ',', $decPoint = '.') : string
    {
        if ($number != 0) {
            return number_format($number, $decimals, $thousandsSep, $decPoint) . '€';
        } else {
            return 'Gratuit';
        }
    }
}
