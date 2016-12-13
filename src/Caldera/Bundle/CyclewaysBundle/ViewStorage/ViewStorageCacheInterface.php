<?php

namespace Caldera\Bundle\CyclewaysBundle\ViewStorage;

use Caldera\Bundle\CalderaBundle\EntityInterface\ViewableInterface;

interface ViewStorageCacheInterface
{
    public function countView(ViewableInterface $viewable);
}