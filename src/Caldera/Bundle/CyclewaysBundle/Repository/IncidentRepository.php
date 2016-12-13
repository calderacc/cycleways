<?php

namespace Caldera\Bundle\CalderaBundle\Repository;

use Caldera\Bundle\CalderaBundle\Entity\Ride;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class IncidentRepository extends EntityRepository
{
    public function findByRide(Ride $ride)
    {
        $builder = $this->createQueryBuilder('incident');

        $builder->select('incident');

        $this->findByRideFilters($builder, $ride);

        $builder->orderBy('incident.title', 'ASC');

        $query = $builder->getQuery();

        return $query->getResult();
    }

    protected function findByRideFilters(QueryBuilder $builder, Ride $ride)
    {
        $builder->where($builder->expr()->eq('incident.city', $ride->getCity()->getId()));
        $builder->andWhere($builder->expr()->lte('incident.visibleFrom', '\'' . $ride->getDateTime()->format('Y-m-d H:i:s') . '\''));
        $builder->andWhere($builder->expr()->gte('incident.visibleTo', '\'' . $ride->getDateTime()->format('Y-m-d H:i:s') . '\''));
        $builder->andWhere($builder->expr()->eq('incident.enabled', 1));
    }

    public function countByRide(Ride $ride)
    {
        $builder = $this->createQueryBuilder('incident');

        $builder->select('COUNT(incident)');

        $this->findByRideFilters($builder, $ride);

        $query = $builder->getQuery();

        return $query->getSingleScalarResult();
    }
}

