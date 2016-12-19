<?php

namespace Caldera\Bundle\CyclewaysBundle\Repository;

use Caldera\Bundle\CyclewaysBundle\Entity\Incident;
use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{
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
}

