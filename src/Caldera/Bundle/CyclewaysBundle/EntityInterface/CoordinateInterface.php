<?php

namespace Caldera\Bundle\CyclewaysBundle\EntityInterface;

interface CoordinateInterface
{
    public function setLatitude($latitude);

    public function getLatitude();

    public function setLongitude($longitude);

    public function getLongitude();
}