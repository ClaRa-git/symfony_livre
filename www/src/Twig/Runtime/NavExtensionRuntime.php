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
     * Méthode pour récupérer les séries par genre
     * @return array
     */
    public function menuSeriesType() : array
    {
        return $this->serieRepository->getCountSeriesByType();
    }

    /**
     * Méthode pour récupérer les filtres pour les items
     * @return array
     */
    public function filtersItems()
    {
        // On retourne un tableau avec les différents filtres
        return [
            ['label' => 'Date de sortie', 'filter' => 'dateStarted ASC', 'icon' => 'fa-sharp fa-solid fa-arrow-up'],
            ['label' => 'Date de sortie', 'filter' => 'dateStarted DESC', 'icon' => 'fa-sharp fa-solid fa-arrow-down'],
            ['label' => 'Titre', 'filter' => 'title ASC', 'icon' => 'fa-sharp fa-solid fa-arrow-up'],
            ['label' => 'Titre', 'filter' => 'title DESC', 'icon' => 'fa-sharp fa-solid fa-arrow-down']
        ];
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
