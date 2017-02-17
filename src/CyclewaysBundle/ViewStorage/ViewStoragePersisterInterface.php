<?php

namespace AppBundle\ViewStorage;

interface ViewStoragePersisterInterface
{
    public function persistViews(): ViewStoragePersisterInterface;
}

