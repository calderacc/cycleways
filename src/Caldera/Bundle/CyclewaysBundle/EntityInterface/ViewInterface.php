<?php

namespace Caldera\Bundle\CyclewaysBundle\EntityInterface;

use Caldera\Bundle\CyclewaysBundle\Entity\User;

interface ViewInterface
{
    public function getId();

    public function setUser(User $user = null);

    public function getUser();

    public function setDateTime(\DateTime $dateTime);

    public function getDateTime();
}