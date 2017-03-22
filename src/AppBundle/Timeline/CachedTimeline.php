<?php

namespace AppBundle\Timeline;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Cache\Adapter\ApcuAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Component\Templating\EngineInterface;

class CachedTimeline extends Timeline
{
    protected $ttl;

    public function __construct(RegistryInterface $doctrine, EngineInterface $templating, int $ttl = 300)
    {
        parent::__construct($doctrine, $templating);

        $this->doctrine = $doctrine;
        $this->templating = $templating;
        $this->ttl = $ttl;
    }

    public function execute(): Timeline
    {
        $cacheKey = 'cycleways-timeline-content';

        if ($this->startDateTime) {
            $cacheKey .= '-start-' . $this->startDateTime->format('Y-m-d');
        }

        if ($this->endDateTime) {
            $cacheKey .= '-end-' . $this->endDateTime->format('Y-m-d');
        }

        $redisConnection = RedisAdapter::createConnection('redis://localhost');

        $this->cache = new RedisAdapter(
            $redisConnection,
            $namespace = '',
            $defaultLifetime = 0
        );

        $timeline = $cache->getItem($cacheKey);

        if (!$timeline->isHit()) {
            $this->process();

            $timeline
                ->set($this->content)
                ->expiresAfter($this->ttl)
            ;

            $cache->save($timeline);
        } else {
            $this->content = $timeline->get();
        }

        return $this;
    }
}

