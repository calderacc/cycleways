<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Incident;
use Doctrine\ORM\EntityRepository;

class IncidentTagRepository extends EntityRepository
{
    public function findForIncident(Incident $incident): array
    {
        $builder = $this->createQueryBuilder('it');

        $builder
            ->where($builder->expr()->eq('it.incident', ':incident'))
            ->setParameter('incident', $incident)
            ->andWhere($builder->expr()->isNull('it.dateTimeRemoved'))
            ->andWhere($builder->expr()->isNull('it.userRemoved'))
            ->orderBy('it.dateTimeAdded', 'ASC');

        $query = $builder->getQuery();

        $result = $query->getResult();

        return $result;
    }
}

