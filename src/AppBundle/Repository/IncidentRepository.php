<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class IncidentRepository extends EntityRepository
{
    public function findByIncidentTypeYear(string $incidentType, int $year): array
    {
        $yearBegin = new \DateTime($year . '-01-01 00:00:00');
        $yearEnd = new \DateTime($year . '-12-31 23:59:59');

        $qb = $this->createQueryBuilder('i');

        $qb
            ->where($qb->expr()->eq('i.incidentType', ':incidentType'))
            ->andWhere($qb->expr()->between('i.dateTime', ':dateFrom', ':dateTo'))
            ->setParameter('incidentType', $incidentType)
            ->setParameter('dateFrom', $yearBegin, \Doctrine\DBAL\Types\Type::DATETIME)
            ->setParameter('dateTo', $yearEnd, \Doctrine\DBAL\Types\Type::DATETIME)
        ;

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function findForTimelineIncidentCollector(\DateTime $startDateTime = null, \DateTime $endDateTime = null, int $limit = null): array
    {
        $builder = $this->createQueryBuilder('incident');

        $builder->select('incident');

        $builder->where($builder->expr()->eq('incident.enabled', 1));

        if ($startDateTime) {
            $builder->andWhere($builder->expr()->gte('incident.creationDateTime', '\'' . $startDateTime->format('Y-m-d H:i:s') . '\''));
        }

        if ($endDateTime) {
            $builder->andWhere($builder->expr()->lte('incident.creationDateTime', '\'' . $endDateTime->format('Y-m-d H:i:s') . '\''));
        }

        if ($limit) {
            $builder->setMaxResults($limit);
        }

        $builder->addOrderBy('incident.creationDateTime', 'DESC');

        $query = $builder->getQuery();

        $result = $query->getResult();

        return $result;
    }
}

