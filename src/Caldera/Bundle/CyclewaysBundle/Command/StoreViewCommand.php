<?php

namespace Caldera\Bundle\CyclewaysBundle\Command;

use Caldera\Bundle\CyclewaysBundle\ViewStorage\ViewStoragePersisterInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StoreViewCommand extends ContainerAwareCommand
{
    /**
     * @var EntityManager $manager
     */
    protected $manager;

    /**
     * @var OutputInterface $output
     */
    protected $output;

    protected function configure()
    {
        $this
            ->setName('cycleways:view:store')
            ->setDescription('Store saved views');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var ViewStoragePersisterInterface $persister */
        $persister = $this->getContainer()->get('caldera.view_storage.persister');

        $persister
            ->setOutput($output)
            ->persistViews();
    }
}
