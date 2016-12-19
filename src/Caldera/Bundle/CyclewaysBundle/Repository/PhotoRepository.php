<?php

namespace Caldera\Bundle\CyclewaysBundle\Repository;

use Caldera\Bundle\CyclewaysBundle\Entity\Photo;
use Doctrine\ORM\EntityRepository;

class PhotoRepository extends EntityRepository
{
    public function getPreviousPhoto(Photo $photo)
    {
        $builder = $this->createQueryBuilder('photo');

        $builder->select('photo');

        if ($photo->getRide()) {
            $builder->where($builder->expr()->eq('photo.ride', $photo->getRide()->getId()));
        } elseif ($photo->getEvent()) {
            $builder->where($builder->expr()->eq('photo.event', $photo->getEvent()->getId()));
        } elseif ($photo->getIncident()) {
            $builder->where($builder->expr()->eq('photo.incident', $photo->getIncident()->getId()));
        }

        $builder->andWhere($builder->expr()->lt('photo.dateTime', '\'' . $photo->getDateTime()->format('Y-m-d H:i:s') . '\''));
        $builder->andWhere($builder->expr()->eq('photo.enabled', 1));
        $builder->andWhere($builder->expr()->eq('photo.deleted', 0));

        $builder->addOrderBy('photo.dateTime', 'DESC');
        $builder->setMaxResults(1);

        $query = $builder->getQuery();

        $result = $query->getOneOrNullResult();

        return $result;
    }

    /**
     * @param Photo $photo
     * @return Photo
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @author maltehuebner
     * @since 2015-12-06
     */
    public function getNextPhoto(Photo $photo)
    {
        $builder = $this->createQueryBuilder('photo');

        $builder->select('photo');

        if ($photo->getRide()) {
            $builder->where($builder->expr()->eq('photo.ride', $photo->getRide()->getId()));
        } elseif ($photo->getEvent()) {
            $builder->where($builder->expr()->eq('photo.event', $photo->getEvent()->getId()));
        } elseif ($photo->getIncident()) {
            $builder->where($builder->expr()->eq('photo.incident', $photo->getIncident()->getId()));
        }

        $builder->andWhere($builder->expr()->gt('photo.dateTime', '\'' . $photo->getDateTime()->format('Y-m-d H:i:s') . '\''));
        $builder->andWhere($builder->expr()->eq('photo.enabled', 1));
        $builder->andWhere($builder->expr()->eq('photo.deleted', 0));

        $builder->addOrderBy('photo.dateTime', 'ASC');
        $builder->setMaxResults(1);

        $query = $builder->getQuery();

        $result = $query->getOneOrNullResult();

        return $result;
    }
}

