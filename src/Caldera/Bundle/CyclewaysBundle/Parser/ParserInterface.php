<?php

namespace Caldera\Bundle\CyclewaysBundle\Parser;

interface ParserInterface
{
    public function parse(string $text): string;
}