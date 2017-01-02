<?php

namespace Caldera\Bundle\CyclewaysBundle\Repository;

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
}

