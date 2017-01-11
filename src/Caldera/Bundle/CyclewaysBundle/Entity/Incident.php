<?php

namespace Caldera\Bundle\CyclewaysBundle\Entity;

use Caldera\Bundle\CyclewaysBundle\EntityInterface\CoordinateInterface;
use Caldera\Bundle\CyclewaysBundle\EntityInterface\ElasticSearchPinInterface;
use Caldera\Bundle\CyclewaysBundle\EntityInterface\ViewableInterface;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Caldera\Bundle\CyclewaysBundle\Repository\IncidentRepository")
 * @ORM\Table(name="incident")
 * @JMS\ExclusionPolicy("all")
 */
class Incident implements CoordinateInterface, ElasticSearchPinInterface, ViewableInterface
{
    const INCIDENT_RAGE = 'rage';
    const INCIDENT_ROADWORKS = 'roadworks';
    const INCIDENT_DANGER = 'danger';
    const INCIDENT_POLICE = 'police';
    const INCIDENT_ACCIDENT = 'accident';
    const INCIDENT_DEADLY_ACCIDENT = 'deadly_accident';
    const INCIDENT_INFRASTRUCTURE = 'infrastructure';

    const DANGER_LEVEL_NONE = 'none';
    const DANGER_LEVEL_LOW = 'low';
    const DANGER_LEVEL_NORMAL = 'normal';
    const DANGER_LEVEL_HIGH = 'high';

    const GEOMETRY_POLYLINE = 'polyline';
    const GEOMETRY_MARKER = 'marker';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Expose
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="incidents")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @JMS\Expose
     */
    protected $slug;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @JMS\Expose
     */
    protected $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @JMS\Expose
     */
    protected $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @JMS\Expose
     */
    protected $geometryType;

    /**
     * @ORM\Column(type="string", length=255)
     * @JMS\Expose
     */
    protected $incidentType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @JMS\Expose
     */
    protected $dangerLevel;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @JMS\Expose
     */
    protected $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @JMS\Expose
     */
    protected $street;

    /**
     * @ORM\Column(type="string", length=16, nullable=true)
     * @JMS\Expose
     */
    protected $houseNumber;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     * @JMS\Expose
     */
    protected $zipCode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @JMS\Expose
     */
    protected $suburb;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @JMS\Expose
     */
    protected $district;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @JMS\Expose
     */
    protected $town;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @JMS\Expose
     */
    protected $village;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @JMS\Expose
     */
    protected $city;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @JMS\Expose
     */
    protected $polyline;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @JMS\Expose
     */
    protected $latitude = null;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @JMS\Expose
     */
    protected $longitude = null;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @JMS\Expose
     */
    protected $dateTime;

    /**
     * @ORM\Column(type="boolean")
     * @JMS\Expose
     */
    protected $expires;

    /**
     * @ORM\Column(type="datetime")
     * @JMS\Expose
     */
    protected $visibleFrom;

    /**
     * @ORM\Column(type="datetime")
     * @JMS\Expose
     */
    protected $visibleTo;

    /**
     * @ORM\Column(type="boolean")
     * @JMS\Expose
     */
    protected $enabled = true;

    /**
     * @ORM\Column(type="datetime")
     * @JMS\Expose
     */
    protected $creationDateTime;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @JMS\Expose
     */
    protected $permalink;

    /**
     * @ORM\Column(type="integer")
     */
    protected $views = 0;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @JMS\Expose
     */
    protected $streetviewLink;

    public function __construct()
    {
        $this->creationDateTime = new \DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setLatitude(float $latitude): CoordinateInterface
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLongitude(float $longitude): CoordinateInterface
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function getPin(): string
    {
        return $this->latitude . ',' . $this->longitude;
    }

    public function getViews(): int
    {
        return $this->views;
    }

    public function setViews(int $views): ViewableInterface
    {
        $this->views = $views;

        return $this;
    }

    public function incViews(): int
    {
        return ++$this->views;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setGeometryType($geometryType)
    {
        $this->geometryType = $geometryType;

        return $this;
    }

    public function getGeometryType()
    {
        return $this->geometryType;
    }

    public function setIncidentType($incidentType)
    {
        $this->incidentType = $incidentType;

        return $this;
    }

    public function getIncidentType()
    {
        return $this->incidentType;
    }

    public function setDangerLevel($dangerLevel)
    {
        $this->dangerLevel = $dangerLevel;

        return $this;
    }

    public function getDangerLevel()
    {
        return $this->dangerLevel;
    }

    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function setHouseNumber($houseNumber)
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    public function getHouseNumber()
    {
        return $this->houseNumber;
    }

    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getZipCode()
    {
        return $this->zipCode;
    }

    public function setSuburb($suburb)
    {
        $this->suburb = $suburb;

        return $this;
    }

    public function getSuburb()
    {
        return $this->suburb;
    }

    public function setDistrict($district)
    {
        $this->district = $district;

        return $this;
    }

    public function getDistrict()
    {
        return $this->district;
    }

    public function setTown($town)
    {
        $this->town = $town;
    }

    public function getTown()
    {
        return $this->town;
    }

    public function setVillage($village)
    {
        $this->village = $village;

        return $this;
    }

    public function getVillage()
    {
        return $this->village;
    }

    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setPolyline($polyline)
    {
        $this->polyline = $polyline;

        return $this;
    }

    public function getPolyline()
    {
        return $this->polyline;
    }

    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    public function getDateTime()
    {
        return $this->dateTime;
    }

    public function setExpires($expires)
    {
        $this->expires = $expires;

        return $this;
    }

    public function getExpires()
    {
        return $this->expires;
    }

    public function setVisibleFrom($visibleFrom)
    {
        $this->visibleFrom = $visibleFrom;

        return $this;
    }

    public function getVisibleFrom()
    {
        return $this->visibleFrom;
    }

    public function setVisibleTo($visibleTo)
    {
        $this->visibleTo = $visibleTo;

        return $this;
    }

    public function getVisibleTo()
    {
        return $this->visibleTo;
    }

    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getEnabled()
    {
        return $this->enabled;
    }

    public function setCreationDateTime($creationDateTime)
    {
        $this->creationDateTime = $creationDateTime;

        return $this;
    }

    public function getCreationDateTime()
    {
        return $this->creationDateTime;
    }

    public function setPermalink($permalink)
    {
        $this->permalink = $permalink;

        return $this;
    }

    public function getPermalink()
    {
        return $this->permalink;
    }

    public function setStreetviewLink($streetviewLink)
    {
        $this->streetviewLink = $streetviewLink;

        return $this;
    }

    public function getStreetviewLink()
    {
        return $this->streetviewLink;
    }

    public function setUser(\Caldera\Bundle\CyclewaysBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    /**
     * @JMS\VirtualProperty
     * @JMS\SerializedName("Timestamp")
     */
    public function getTimestamp()
    {
        return $this->dateTime->format('U');
    }

    /**
     * @JMS\VirtualProperty
     * @JMS\SerializedName("CreationTimestamp")
     */
    public function getCreationTimestamp()
    {
        return $this->creationDateTime->format('U');
    }

    /**
     * @JMS\VirtualProperty
     * @JMS\SerializedName("VisibleFromTimestamp")
     */
    public function getVisibleFromTimestamp()
    {
        return $this->creationDateTime->format('U');
    }

    /**
     * @JMS\VirtualProperty
     * @JMS\SerializedName("VisibleToTimestamp")
     */
    public function getVisibleToTimestamp()
    {
        return $this->creationDateTime->format('U');
    }

    public function getCyclewaysId(): string
    {
        if (!$this->permalink) {
            return 'undefined';
        }

        $code = substr($this->permalink, -5);

        $cyclewaysId = strtoupper($code);

        return $cyclewaysId;
    }
}
