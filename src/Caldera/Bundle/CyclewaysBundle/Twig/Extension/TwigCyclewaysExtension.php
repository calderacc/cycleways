<?php

namespace Caldera\Bundle\CyclewaysBundle\Twig\Extension;

use Caldera\Bundle\CyclewaysBundle\Entity\Incident;

class TwigCyclewaysExtension extends \Twig_Extension
{
    public function getFunctions(): array
    {
        return [
            new \Twig_SimpleFunction('getCityName', [$this, 'getCityName'], array(
                'is_safe' => array('html')
            ))
        ];
    }

    public function getCityName(Incident $incident): ?string
    {
        if ($incident->getCity()) {
            return $incident->getCity();
        }

        if ($incident->getTown()) {
            return $incident->getTown();
        }

        if ($incident->getVillage()) {
            return $incident->getVillage();
        }

        return null;
    }

    public function getName(): string
    {
        return 'cycleways_extension';
    }
}

