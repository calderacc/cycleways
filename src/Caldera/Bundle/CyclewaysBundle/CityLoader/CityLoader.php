<?php

namespace Caldera\Bundle\CyclewaysBundle\CityLoader;

use Caldera\Bundle\CyclewaysBundle\Entity\City;

class CityLoader
{
    const SOURCE_URL = 'http://www.fa-technik.adfc.de/code/opengeodb/DE.tab';
    const FIELD_LATITUDE = 4;
    const FIELD_LONGITUDE = 5;
    const FIELD_ZIP = 7;

    protected $lines = [];

    public function __construct()
    {

    }

    public function loadData(): CityLoader
    {
        $this->lines = file(self::SOURCE_URL);
        array_shift($this->lines);

        return $this;
    }

    public function parseData(): City
    {
        $line = array_shift($this->lines);

        $parts = explode("\t", $line);

        if (count($parts) == 16 && $parts[self::FIELD_ZIP]) {
            var_dump($parts);
            die;
        }




        $city = new City();

        return $city;
    }

    public function hasData(): int
    {
        return count($this->lines);
    }
}