<?php

namespace Caldera\Bundle\CyclewaysBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity as UniqueEntity;

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

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return City
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return City
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     *
     * @return City
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     *
     * @return City
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set zip
     *
     * @param string $zip
     *
     * @return City
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set locId
     *
     * @param int $locId
     *
     * @return City
     */
    public function setLocId(int $locId)
    {
        $this->locId = $locId;

        return $this;
    }

    /**
     * Get locId
     *
     * @return \int
     */
    public function getLocId()
    {
        return $this->locId;
    }
}
