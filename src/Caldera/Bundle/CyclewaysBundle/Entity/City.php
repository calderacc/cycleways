<?php

namespace Caldera\Bundle\CyclewaysBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="Caldera\Bundle\CyclewaysBundle\Repository\CityRepository")
 * @ORM\Table(name="city")
 * @JMS\ExclusionPolicy("all")
 */
class City
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Expose
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @JMS\Expose
     */
    protected $slug;

    /**
     * @ORM\Column(type="string", length=255)
     * @JMS\Expose
     */
    protected $name;

    /**
     * @ORM\Column(type="float")
     * @JMS\Expose
     */
    protected $latitude = 0;

    /**
     * @ORM\Column(type="float")
     * @JMS\Expose
     */
    protected $longitude = 0;

    /**
     * @ORM\Column(type="string", length=5)
     * @JMS\Expose
     */
    protected $zip;

    /**
     * @ORM\Column(type="integer")
     * @JMS\Expose
     */
    protected $locId;

    public function __construct()
    {

    }
}
