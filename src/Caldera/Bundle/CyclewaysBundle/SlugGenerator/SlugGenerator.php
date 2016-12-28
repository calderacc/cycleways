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
        $slug = new Slug($incident->getTitle().' '.$incident->getStreet().' '.$incident->getDistrict().' '.$incident->getCity()->getName().' '.$incident->getId());
        $incident->setSlug($slug);

        return $slug;
    }
}