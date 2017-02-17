<?php

namespace Caldera\Bundle\CyclewaysBundle\ViewStorage;

interface ViewStoragePersisterInterface
{
    public function persistViews(): ViewStoragePersisterInterface;
}

