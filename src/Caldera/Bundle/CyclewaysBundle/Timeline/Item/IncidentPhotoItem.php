<?php

namespace Caldera\Bundle\CyclewaysBundle\Timeline\Item;

class IncidentPhotoItem extends AbstractItem
{
    /**
     * @var string $username
     */
    protected $username;

    /**
     * @var Ride $ride
     */
    protected $ride;

    /**
     * @var City $city
     */
    protected $city;

    /**
     * @var string $rideTitle
     */
    protected $rideTitle;

    /**
     * @var integer $counter
     */
    protected $counter;

    /**
     * @var Photo $previewPhoto
     */
    protected $previewPhoto;

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return Ride
     */
    public function getRide()
    {
        return $this->ride;
    }

    /**
     * @param Ride $ride
     */
    public function setRide($ride)
    {
        $this->ride = $ride;

        return $this;
    }

    /**
     * @return City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param City $city
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getRideTitle()
    {
        return $this->rideTitle;
    }

    /**
     * @param string $rideTitle
     */
    public function setRideTitle($rideTitle)
    {
        $this->rideTitle = $rideTitle;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCounter()
    {
        return $this->counter;
    }

    /**
     * @param integer $counter
     */
    public function setCounter($counter)
    {
        $this->counter = $counter;

        return $this;
    }

    /**
     * @param Photo $previewPhoto
     */
    public function setPreviewPhoto(Photo $previewPhoto)
    {
        $this->previewPhoto = $previewPhoto;

        return $this;
    }

    /**
     * @return Photo
     */
    public function getPreviewPhoto()
    {
        return $this->previewPhoto;
    }
}