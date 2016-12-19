<?php

namespace Caldera\Bundle\CyclewaysBundle\EntityInterface;

interface CoordinateInterface
{
    public function setLatitude(float $latitude): CoordinateInterface;

    public function getLatitude(): ?float;

    public function setLongitude(float $longitude): CoordinateInterface;

    public function getLongitude(): ?float;
}