<?php

namespace Caldera\Bundle\CyclewaysBundle\Parser\MultiStepParser;

use Caldera\Bundle\CyclewaysBundle\Parser\ParserInterface;

class MultiStepParser implements ParserInterface
{
    protected $steps = [];

    public function addStep(StepInterface $step)
    {
        $this->steps[] = $step;
    }

    public function parse(string $text): string
    {
        foreach ($this->steps as $step) {
            $text = $step->parse($text);
        }

        return $text;
    }
}