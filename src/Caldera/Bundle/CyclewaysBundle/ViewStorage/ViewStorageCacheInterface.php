<?php

namespace Caldera\Bundle\CyclewaysBundle\ViewStorage;

use Caldera\Bundle\CyclewaysBundle\EntityInterface\ViewableInterface;

interface ViewStorageCacheInterface
{
    public function countView(ViewableInterface $viewable);
}