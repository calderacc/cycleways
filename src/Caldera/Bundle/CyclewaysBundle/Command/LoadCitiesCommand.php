<?php

namespace Caldera\Bundle\CyclewaysBundle\Command;

use Caldera\Bundle\CyclewaysBundle\CityLoader\CityLoader;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LoadCitiesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('cycleways:city:load')
            ->setDescription('Load cities');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $cityLoader = new CityLoader();

        $cityLoader->loadData();

        $progress = new ProgressBar($output, $cityLoader->countData());
        $progress->start();

        while ($cityLoader->hasData()) {
            $cityLoader->parseData();
            $progress->advance();
        }

        $progress->finish();
    }
}
