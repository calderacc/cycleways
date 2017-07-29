<?php

namespace AppBundle\Entity;

use AppBundle\EntityInterface\ViewableInterface;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Table(name="photo")
 * @Vich\Uploadable
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PhotoRepository")
 * @JMS\ExclusionPolicy("all")
 */
class Photo implements ViewableInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Expose
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="photos")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="City", inversedBy="photos")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    protected $city;

    /**
     * @ORM\ManyToOne(targetEntity="Incident", inversedBy="photos")
     * @ORM\JoinColumn(name="incident_id", referencedColumnName="id")
     */
    protected $incident;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @JMS\Expose
     */
    protected $latitude;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @JMS\Expose
     */
    protected $longitude;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @JMS\Expose
     */
    protected $description;

    /**
     * @ORM\Column(type="integer")
     */
    protected $views = 0;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $enabled = true;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $deleted = false;

    /**
     * @ORM\Column(type="datetime")
     * @JMS\Expose
     */
    protected $dateTime;

    /**
     * @ORM\Column(type="datetime")
     * @JMS\Expose
     */
    protected $creationDateTime;

    /**
     * @Vich\UploadableField(mapping="photo_photo", fileNameProperty="imageName")
     *
     * @var File
     */
    protected $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    protected $imageName;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    protected $updatedAt;

    public function __construct()
    {
        $this->dateTime = new \DateTime();
        $this->creationDateTime = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->description = '';
    }

    public function getId(): int
    {
        return $this->id;
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

    public function setLatitude(float $latitude): Photo
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLongitude(float $longitude): Photo
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setDescription(string $description): Photo
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setEnabled(bool $enabled): Photo
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getEnabled(): bool
    {
        return $this->enabled;
    }

    public function setDeleted(bool $deleted): Photo
    {
        $this->deleted = $deleted;

        return $this;
    }

    public function getDeleted(): bool
    {
        return $this->deleted;
    }

    public function setDateTime(\DateTime $dateTime): Photo
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    public function getDateTime(): ?\DateTime
    {
        return $this->dateTime;
    }

    public function setCreationDateTime(\DateTime $creationDateTime): Photo
    {
        $this->creationDateTime = $creationDateTime;

        return $this;
    }

    public function getCreationDateTime(): ?\DateTime
    {
        return $this->creationDateTime;
    }

    public function setImageName(string $imageName): Photo
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setUpdatedAt(\DateTime $updatedAt): Photo
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUser(User $user = null): Photo
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setCity(City $city = null): Photo
    {
        $this->city = $city;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setIncident(Incident $incident = null): Photo
    {
        $this->incident = $incident;

        return $this;
    }

    public function getIncident(): ?Incident
    {
        return $this->incident;
    }

    public function setImageFile(File $image = null): Photo
    {
        $this->imageFile = $image;

        if ($image) {
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
}
