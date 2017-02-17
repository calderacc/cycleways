<?php

namespace AppBundle\Twig\Extension;

use AppBundle\Parser\ParserInterface;

class TwigParseExtension extends \Twig_Extension
{
    /** @var ParserInterface $parser */
    protected $parser;

    public function __construct(ParserInterface $parser)
    {
        $this->parser = $parser;
    }

    public function getFilters(): array
    {
        return [
            new \Twig_SimpleFilter('parse', [$this, 'parse'], array(
                'is_safe' => array('html')
            ))
        ];
    }

    public function parse(string $text): string
    {
        return $this->parser->parse($text);
    }

    public function getName(): string
    {
        return 'parse_extension';
    }
}

