<?php

namespace Caldera\Bundle\CyclewaysBundle\EntityInterface;

interface ViewableInterface
{
    public function getId(): int;

    public function getViews(): int;

    public function setViews(int $views): ViewableInterface;

    public function incViews(): int;
}