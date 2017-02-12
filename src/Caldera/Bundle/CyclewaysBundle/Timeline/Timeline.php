<?php

namespace Caldera\Bundle\CyclewaysBundle\Timeline;

use Caldera\Bundle\CyclewaysBundle\Timeline\Collector\AbstractTimelineCollector;
use Caldera\Bundle\CyclewaysBundle\Timeline\Item\ItemInterface;
use Doctrine\Bundle\DoctrineBundle\Registry;

class Timeline
{
    /** @var Registry $doctrine */
    protected $doctrine;

    protected $templating;

    protected $collectorList = [];
    protected $items = [];
    protected $content = '';

    protected $startDateTime = null;
    protected $endDateTime = null;

    public function __construct(Registry $doctrine, $templating)
    {
        $this->doctrine = $doctrine;
        $this->templating = $templating;
    }

    public function addCollector(AbstractTimelineCollector $collector): Timeline
    {
        array_push($this->collectorList, $collector);

        return $this;
    }

    public function setDateRange(\DateTime $startDateTime, \DateTime $endDateTime): Timeline
    {
        $this->startDateTime = $startDateTime;
        $this->endDateTime = $endDateTime;

        return $this;
    }

    public function execute(): Timeline
    {
        $this->process();

        return $this;
    }

    protected function process(): Timeline
    {
        /**
         * @var AbstractTimelineCollector $collector
         */
        foreach ($this->collectorList as $collector) {
            $collector->setDateRange($this->startDateTime, $this->endDateTime);

            $collector->execute();

            $this->items = array_merge($this->items, $collector->getItems());
        }

        krsort($this->items);

        $this->paginate();

        $this->createContent();

        return $this;
    }

    protected function paginate(): Timeline
    {
        $lastDateTime = new \DateTime();
        $threeMonthDateInterval = new \DateInterval('P12M');
        $lastDateTime->sub($threeMonthDateInterval);

        $maxItems = 50;
        $counter = 0;

        foreach ($this->items as $key => $item) {
            ++$counter;

            if ($item->getDateTime() < $lastDateTime || $counter > $maxItems) {
                //unset($this->items[$key]);
            }
        }

        return $this;
    }

    protected function createContent(): Timeline
    {
        foreach ($this->items as $item) {
            $templateName = $this->templateNameForItem($item);

            $this->content .= $this->templating->render(
                'CalderaCyclewaysBundle:Timeline/Items:' . $templateName . '.html.twig',
                [
                    'item' => $item
                ]
            );
        }

        return $this;
    }

    protected function templateNameForItem(ItemInterface $item): string
    {
        $itemFullClassName = get_class($item);

        $itemClassNamespaces = explode('\\', $itemFullClassName);

        $itemClassName = array_pop($itemClassNamespaces);

        $templateName = lcfirst(str_replace('Item', '', $itemClassName));

        return $templateName;
    }

    public function getTimelineContent(): string
    {
        return $this->content;
    }
}

