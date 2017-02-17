<?php

namespace Caldera\Bundle\CyclewaysBundle\SlugGenerator;

use Caldera\Bundle\CyclewaysBundle\Entity\Incident;
use Malenki\Slug;

class SlugGenerator
{
    public function __construct()
    {
    }

    public function generateSlug(Incident $incident): string
    {
        $slugArray = [];
        $slugArray[] = $incident->getTitle();
        $slugArray[] = $incident->getStreet() ?? null;
        $slugArray[] = $incident->getDistrict() ?? null;
        $slugArray[] = $incident->getSuburb() ?? null;
        $slugArray[] = $incident->getTown() ?? null;
        $slugArray[] = $incident->getVillage() ?? null;
        $slugArray[] = $incident->getCity() ?? null;
        $slugArray[] = $incident->getId();

        $slugString = implode('-', array_filter($slugArray));

        $slug = new Slug($slugString);
        $incident->setSlug($slug);

        return $slug;
    }
}
