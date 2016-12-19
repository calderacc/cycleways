<?php

namespace Caldera\Bundle\CyclewaysBundle\Traits;

use Caldera\Bundle\CyclewaysBundle\Entity\Photo;
use Caldera\Bundle\CyclewaysBundle\EntityInterface\ViewableInterface;
use Caldera\Bundle\CyclewaysBundle\ViewStorage\ViewStorageCacheInterface;

trait ViewStorageTrait
{
    protected function countView(ViewableInterface $viewable)
    {
        /** @var ViewStorageCacheInterface $viewStorage */
        $viewStorage = $this->get('caldera.view_storage.cache');

        $viewStorage->countView($viewable);
    }

    /**
     * @param Photo $photo
     * @deprecated
     */
    protected function countPhotoView(Photo $photo)
    {
        $this->countView($photo);
    }
}