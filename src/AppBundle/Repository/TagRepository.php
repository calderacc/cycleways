<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Incident;
use Doctrine\ORM\EntityRepository;

class TagRepository extends EntityRepository
{
    public function findTagsForIncident(Incident $incident): array
    {
        $builder = $this->createQueryBuilder('t');

        $builder
            ->join('t.incidentTagList', 'itl')
            ->where($builder->expr()->eq('itl.incident', ':incident'))
            ->setParameter('incident', $incident)
            ->andWhere($builder->expr()->isNull('itl.dateTimeRemoved'))
            ->orderBy('itl.dateTimeAdded', 'ASC');

        $query = $builder->getQuery();

        $result = $query->getResult();

        return $result;
    }
}

