<?php

namespace AppBundle\Traits;

use AppBundle\Entity\Photo;
use AppBundle\EntityInterface\ViewableInterface;
use AppBundle\ViewStorage\ViewStorageCacheInterface;

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