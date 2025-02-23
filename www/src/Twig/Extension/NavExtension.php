<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\NavExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class NavExtension extends AbstractExtension
{
    /**
     * Méthode pour définir les filtres
     * @return array
     */
    public function getFilters(): array
    {
        return [
           new TwigFilter('number_format', [NavExtensionRuntime::class, 'numberFormat']),
           new TwigFilter('badge_user', [NavExtensionRuntime::class, 'badgeUser'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * Méthode pour définir les fonctions
     * @return array
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('menu_series_author', [NavExtensionRuntime::class, 'menuSeriesAuthor']),
            new TwigFunction('menu_series_editor', [NavExtensionRuntime::class, 'menuSeriesEditor']),
            new TwigFunction('menu_series_type', [NavExtensionRuntime::class, 'menuSeriesType']),
            new TwigFunction('filters_items', [NavExtensionRuntime::class, 'filtersItems'])
        ];
    }
}
