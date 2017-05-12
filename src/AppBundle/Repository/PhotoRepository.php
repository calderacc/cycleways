<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Photo;
use Doctrine\ORM\EntityRepository;

class PhotoRepository extends EntityRepository
{
    public function getPreviousPhoto(Photo $photo): ?Photo
    {
        $builder = $this->createQueryBuilder('photo');

        $builder->select('photo');
        $builder->where($builder->expr()->eq('photo.incident', $photo->getIncident()->getId()));

        //$builder->andWhere($builder->expr()->lt('photo.dateTime', '\'' . $photo->getDateTime()->format('Y-m-d H:i:s') . '\''));
        $builder->andWhere($builder->expr()->lt('photo.id', $photo->getId()));
        $builder->andWhere($builder->expr()->eq('photo.enabled', 1));
        $builder->andWhere($builder->expr()->eq('photo.deleted', 0));

        $builder->addOrderBy('photo.id', 'DESC');
        //$builder->addOrderBy('photo.dateTime', 'DESC');

        $builder->setMaxResults(1);

        $query = $builder->getQuery();

        $result = $query->getOneOrNullResult();

        return $result;
    }

    public function getNextPhoto(Photo $photo): ?Photo
    {
        $builder = $this->createQueryBuilder('photo');

        $builder->select('photo');

        $builder->where($builder->expr()->eq('photo.incident', $photo->getIncident()->getId()));

        //$builder->andWhere($builder->expr()->gt('photo.dateTime', '\'' . $photo->getDateTime()->format('Y-m-d H:i:s') . '\''));
        $builder->andWhere($builder->expr()->gt('photo.id', $photo->getId()));
        $builder->andWhere($builder->expr()->eq('photo.enabled', 1));
        $builder->andWhere($builder->expr()->eq('photo.deleted', 0));

        $builder->addOrderBy('photo.id', 'ASC');
        //$builder->addOrderBy('photo.dateTime', 'ASC');

        $builder->setMaxResults(1);

        $query = $builder->getQuery();

        $result = $query->getOneOrNullResult();

        return $result;
    }


    public function findForTimelinePhotoCollector(
        \DateTime $startDateTime = null,
        \DateTime $endDateTime = null,
        int $limit = null
    ): array {
        $builder = $this->createQueryBuilder('photo');

        $builder->select('photo');

        $builder->where($builder->expr()->eq('photo.enabled', 1));
        $builder->andWhere($builder->expr()->eq('photo.deleted', 0));

        if ($startDateTime) {
            $builder->andWhere(
                $builder->expr()->gte('photo.creationDateTime', '\''.$startDateTime->format('Y-m-d H:i:s').'\'')
            );
        }

        if ($endDateTime) {
            $builder->andWhere(
                $builder->expr()->lte('photo.creationDateTime', '\''.$endDateTime->format('Y-m-d H:i:s').'\'')
            );
        }

        if ($limit) {
            $builder->setMaxResults($limit);
        }

        $builder->addOrderBy('photo.creationDateTime', 'DESC');

        $query = $builder->getQuery();

        return $query->getResult();
    }

    public function findLatestGroupedByIncident(int $limit = 10): array
    {
        $builder = $this->createQueryBuilder('p');

        $builder
            ->where($builder->expr()->eq('p.enabled', 1))
            ->andWhere($builder->expr()->eq('p.deleted', 0))
            ->groupBy('p.incident')
            ->orderBy('p.dateTime', 'DESC')
            ->setMaxResults($limit)
        ;

        $query = $builder->getQuery();

        return $query->getResult();
    }
}

