<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Incident;
use AppBundle\Entity\Status;
use Doctrine\ORM\EntityRepository;

class StatusRepository extends EntityRepository
{
    public function findCurrentStatusForIncident(Incident $incident): ?Status
    {
        $qb = $this->createQueryBuilder('s');

        $qb
            ->where($qb->expr()->eq('s.incident', ':incident'))
            ->setParameter('incident', $incident)
            ->orderBy('i.dateTime', 'DESC')
        ;

        $query = $qb->getQuery();

        return $query->getOneOrNullResult();
    }
}

