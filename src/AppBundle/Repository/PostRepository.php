<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Incident;
use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{
    public function findLatest(int $limit = 10): array
    {
        $builder = $this->createQueryBuilder('post');

        $builder
            ->select('post')
            ->andWhere($builder->expr()->eq('post.enabled', true))
            ->addOrderBy('post.dateTime', 'DESC')
            ->setMaxResults($limit)
        ;

        $query = $builder->getQuery();

        return $query->getResult();
    }

    public function getPostsForIncident(Incident $incident): array
    {
        $builder = $this->createQueryBuilder('post');

        $builder->select('post');
        $builder->where($builder->expr()->eq('post.incident', $incident->getId()));
        $builder->andWhere($builder->expr()->eq('post.enabled', true));
        $builder->addOrderBy('post.dateTime', 'ASC');

        $query = $builder->getQuery();

        $result = $query->getResult();

        return $result;
    }

    public function findForTimelineIncidentPostCollector(\DateTime $startDateTime = null, \DateTime $endDateTime = null, int $limit = null): array
    {
        $builder = $this->createQueryBuilder('post');

        $builder->select('post');

        $builder->where($builder->expr()->eq('post.enabled', 1));
        $builder->andWhere($builder->expr()->isNotNull('post.incident'));

        if ($startDateTime) {
            $builder->andWhere($builder->expr()->gte('post.dateTime', '\'' . $startDateTime->format('Y-m-d H:i:s') . '\''));
        }

        if ($endDateTime) {
            $builder->andWhere($builder->expr()->lte('post.dateTime', '\'' . $endDateTime->format('Y-m-d H:i:s') . '\''));
        }

        if ($limit) {
            $builder->setMaxResults($limit);
        }

        $builder->addOrderBy('post.dateTime', 'DESC');

        $query = $builder->getQuery();

        $result = $query->getResult();

        return $result;
    }
}

