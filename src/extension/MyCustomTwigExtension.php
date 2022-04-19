<?php


namespace App\extension;


use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class MyCustomTwigExtension extends AbstractExtension
{

    public function getFilters()
    {
        return [
            new TwigFilter('defaultImage', [$this, 'defaultImage'])
        ];
    }

    public function defaultImage(string $path) : string
    {
        if (strlen(trim($path)) == 0)
            return 'farid.jpg';
        else
            return $path;
    }

}