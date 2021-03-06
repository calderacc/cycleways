<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity as UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CityRepository")
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

    /**
     * @ORM\Column(type="integer")
     * @JMS\Expose
     */
    protected $population;

    /**
     * @ORM\Column(type="integer")
     * @JMS\Expose
     */
    protected $area;

    public function __construct()
    {

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setSlug(string $slug): City
    {
        $this->slug = $slug;

        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setName(string $name): City
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setLatitude(float $latitude): City
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function setLongitude(float $longitude): City
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function setZip(string $zip): City
    {
        $this->zip = $zip;

        return $this;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function setLocId(int $locId): City
    {
        $this->locId = $locId;

        return $this;
    }

    public function getLocId(): int
    {
        return $this->locId;
    }

    public function setPopulation(int $population): City
    {
        $this->population = $population;

        return $this;
    }

    public function getPopulation(): int
    {
        return $this->population;
    }

    public function setArea(int $area): City
    {
        $this->area = $area;

        return $this;
    }

    public function getArea(): int
    {
        return $this->area;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
