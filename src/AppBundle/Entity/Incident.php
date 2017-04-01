<?php

namespace AppBundle\Entity;

use AppBundle\EntityInterface\CoordinateInterface;
use AppBundle\EntityInterface\ElasticSearchPinInterface;
use AppBundle\EntityInterface\ViewableInterface;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IncidentRepository")
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

    const ACCIDENT_TYPE_SOLO = 'solo';
    const ACCIDENT_TYPE_UNKNOWN = 'unknown';
    const ACCIDENT_TYPE_OTHER = 'other';
    const ACCIDENT_TYPE_CROSSING = 'crossing';
    const ACCIDENT_TYPE_RIGHTOFWAY = 'rightofway';
    const ACCIDENT_TYPE_REDLIGHT= 'redlight';
    const ACCIDENT_TYPE_RIGHTTURN = 'rightturm';
    const ACCIDENT_TYPE_FRONTAL = 'frontal';
    const ACCIDENT_TYPE_OVERTAKE = 'overtake';
    const ACCIDENT_TYPE_RAM = 'ram';
    const ACCIDENT_TYPE_PULLIN = 'pullin';
    const ACCIDENT_TYPE_DOORING = 'dooring';

    const ACCIDENT_SEX_MALE = 'm';
    const ACCIDENT_SEX_FEMALE = 'f';

    const ACCIDENT_LOCATION_CITY = 'city';
    const ACCIDENT_LOCATION_LAND = 'land';

    const ACCIDENT_INFRASTRUCTURE_ROAD = 'road';
    const ACCIDENT_INFRASTRUCTURE_CYCLEPATH = 'cyclepath';
    const ACCIDENT_INFRASTRUCTURE_SIDEWALK = 'sidewalk';
    const ACCIDENT_INFRASTRUCTURE_RADFAHRSTREIFEN = 'radfahrstreifen';
    const ACCIDENT_INFRASTRUCTURE_SCHUTZSTREIFEN = 'schutzstreifen';
    const ACCIDENT_INFRASTRUCTURE_FAHRRADSTRASSE = 'fahrradstrasse';
    const ACCIDENT_INFRASTRUCTURE_OTHER = 'other';

    const ACCIDENT_OPPONENT_PEDESTRIAN = 'pedestrian';
    const ACCIDENT_OPPONENT_CYCLIST = 'cyclist';
    const ACCIDENT_OPPONENT_MOTORCYCLE = 'motorcycle';
    const ACCIDENT_OPPONENT_CAR = 'car';
    const ACCIDENT_OPPONENT_TRUCK = 'truck';
    const ACCIDENT_OPPONENT_TRACTOR = 'tractor';
    const ACCIDENT_OPPONENT_TRAIN = 'train';
    const ACCIDENT_OPPONENT_TRAM = 'tram';
    const ACCIDENT_OPPONENT_ANIMAL = 'animal';
    const ACCIDENT_OPPONENT_NONE = 'none';
    const ACCIDENT_OPPONENT_UNKNOWN = 'unknown';

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

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @JMS\Expose
     */
    protected $accidentType = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @JMS\Expose
     */
    protected $accidentLocation = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @JMS\Expose
     */
    protected $accidentInfrastructure = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @JMS\Expose
     */
    protected $accidentOpponent = null;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     * @JMS\Expose
     */
    protected $accidentSex = null;

    /**
     * @ORM\Column(type="integer", length=255, nullable=true)
     * @JMS\Expose
     */
    protected $accidentAge = null;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @JMS\Expose
     */
    protected $accidentPedelec = null;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @JMS\Expose
     */
    protected $accidentHelmet = null;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @JMS\Expose
     */
    protected $accidentAlcohol = null;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @JMS\Expose
     */
    protected $accidentCyclistCaused = null;

    public function __construct()
    {
        $this->creationDateTime = new \DateTime();
        $this->dateTime = new \DateTime();
        $this->visibleFrom = new \DateTime();
        $this->visibleTo = new \DateTime();
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

    public function setSlug(string $slug): Incident
    {
        $this->slug = $slug;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setTitle(string $title): Incident
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setDescription(string $description): Incident
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setGeometryType(string $geometryType): Incident
    {
        $this->geometryType = $geometryType;

        return $this;
    }

    public function getGeometryType(): ?string
    {
        return $this->geometryType;
    }

    public function setIncidentType(string $incidentType): Incident
    {
        $this->incidentType = $incidentType;

        return $this;
    }

    public function getIncidentType(): ?string
    {
        return $this->incidentType;
    }

    public function setDangerLevel(string $dangerLevel): Incident
    {
        $this->dangerLevel = $dangerLevel;

        return $this;
    }

    public function getDangerLevel(): ?string
    {
        return $this->dangerLevel;
    }

    public function setAddress(string $address): Incident
    {
        $this->address = $address;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setStreet(string $street): Incident
    {
        $this->street = $street;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setHouseNumber(string $houseNumber): Incident
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    public function getHouseNumber(): ?string
    {
        return $this->houseNumber;
    }

    public function setZipCode(string $zipCode): Incident
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setSuburb(string $suburb): Incident
    {
        $this->suburb = $suburb;

        return $this;
    }

    public function getSuburb(): ?string
    {
        return $this->suburb;
    }

    public function setDistrict(string $district): Incident
    {
        $this->district = $district;

        return $this;
    }

    public function getDistrict(): ?string
    {
        return $this->district;
    }

    public function setTown(string $town): Incident
    {
        $this->town = $town;

        return $this;
    }

    public function getTown(): ?string
    {
        return $this->town;
    }

    public function setVillage(string $village): Incident
    {
        $this->village = $village;

        return $this;
    }

    public function getVillage(): ?string
    {
        return $this->village;
    }

    public function setCity(string $city): Incident
    {
        $this->city = $city;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setPolyline(string $polyline): Incident
    {
        $this->polyline = $polyline;

        return $this;
    }

    public function getPolyline(): ?string
    {
        return $this->polyline;
    }

    public function setDateTime(\DateTime $dateTime): Incident
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    public function getDateTime(): ?\DateTime
    {
        return $this->dateTime;
    }

    public function setExpires(bool $expires): Incident
    {
        $this->expires = $expires;

        return $this;
    }

    public function getExpires(): ?bool
    {
        return $this->expires;
    }

    public function setVisibleFrom(\DateTime $visibleFrom): Incident
    {
        $this->visibleFrom = $visibleFrom;

        return $this;
    }

    public function getVisibleFrom(): ?\DateTime
    {
        return $this->visibleFrom;
    }

    public function setVisibleTo(\DateTime $visibleTo): Incident
    {
        $this->visibleTo = $visibleTo;

        return $this;
    }

    public function getVisibleTo(): ?\DateTime
    {
        return $this->visibleTo;
    }

    public function setEnabled(bool $enabled): Incident
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setCreationDateTime(\DateTime $creationDateTime): Incident
    {
        $this->creationDateTime = $creationDateTime;

        return $this;
    }

    public function getCreationDateTime(): ?\DateTime
    {
        return $this->creationDateTime;
    }

    public function setPermalink(string $permalink): Incident
    {
        $this->permalink = $permalink;

        return $this;
    }

    public function getPermalink(): ?string
    {
        return $this->permalink;
    }

    public function setStreetviewLink(string $streetviewLink): Incident
    {
        $this->streetviewLink = $streetviewLink;

        return $this;
    }

    public function getStreetviewLink(): ?string
    {
        return $this->streetviewLink;
    }

    public function setUser(User $user = null): Incident
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @JMS\VirtualProperty
     * @JMS\SerializedName("Timestamp")
     */
    public function getTimestamp(): int
    {
        return $this->dateTime->format('U');
    }

    /**
     * @JMS\VirtualProperty
     * @JMS\SerializedName("CreationTimestamp")
     */
    public function getCreationTimestamp(): int
    {
        return $this->creationDateTime->format('U');
    }

    /**
     * @JMS\VirtualProperty
     * @JMS\SerializedName("VisibleFromTimestamp")
     */
    public function getVisibleFromTimestamp(): int
    {
        return $this->creationDateTime->format('U');
    }

    /**
     * @JMS\VirtualProperty
     * @JMS\SerializedName("VisibleToTimestamp")
     */
    public function getVisibleToTimestamp(): int
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

    public function getAccidentType(): ?string
    {
        return $this->accidentType;
    }

    public function setAccidentType(string $accidentType = null): Incident
    {
        $this->accidentType = $accidentType;

        return $this;
    }

    public function getAccidentLocation(): ?string
    {
        return $this->accidentLocation;
    }

    public function setAccidentLocation(string $accidentLocation = null): Incident
    {
        $this->accidentLocation = $accidentLocation;

        return $this;
    }

    public function getAccidentInfrastructure(): ?string
    {
        return $this->accidentInfrastructure;
    }

    public function setAccidentInfrastructure(string $accidentInfrastructure = null): Incident
    {
        $this->accidentInfrastructure = $accidentInfrastructure;

        return $this;
    }

    public function getAccidentOpponent(): ?string
    {
        return $this->accidentOpponent;
    }

    public function setAccidentOpponent(string $accidentOpponent = null): Incident
    {
        $this->accidentOpponent = $accidentOpponent;

        return $this;
    }

    public function getAccidentSex(): ?string
    {
        return $this->accidentSex;
    }

    public function setAccidentSex(string $accidentSex = null): Incident
    {
        $this->accidentSex = $accidentSex;

        return $this;
    }

    public function getAccidentAge(): ?int
    {
        return $this->accidentAge;
    }

    public function setAccidentAge(int $accidentAge = null): Incident
    {
        $this->accidentAge = $accidentAge;

        return $this;
    }

    public function getAccidentPedelec(): ?bool
    {
        return $this->accidentPedelec;
    }

    public function setAccidentPedelec(bool $accidentPedelec = null): Incident
    {
        $this->accidentPedelec = $accidentPedelec;

        return $this;
    }

    public function getAccidentHelmet(): ?bool
    {
        return $this->accidentHelmet;
    }

    public function setAccidentHelmet(bool $accidentHelmet = null): Incident
    {
        $this->accidentHelmet = $accidentHelmet;

        return $this;
    }

    public function getAccidentAlcohol(): ?float
    {
        return $this->accidentAlcohol;
    }

    public function setAccidentAlcohol(float $accidentAlcohol = null): Incident
    {
        $this->accidentAlcohol = $accidentAlcohol;

        return $this;
    }

    public function getAccidentCyclistCaused(): ?string
    {
        return $this->accidentCyclistCaused;
    }

    public function setAccidentCyclistCaused(string $accidentCyclistCaused = null): Incident
    {
        $this->accidentCyclistCaused = $accidentCyclistCaused;

        return $this;
    }
}
