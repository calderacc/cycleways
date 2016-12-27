<?php

namespace Caldera\Bundle\CyclewaysBundle\Parser\MultiStepParser;

interface StepInterface
{
    public function parse(string $text): string;
}