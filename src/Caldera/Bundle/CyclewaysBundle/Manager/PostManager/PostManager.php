<?php

namespace Caldera\Bundle\CyclewaysBundle\Manager\PostManager;

use Caldera\Bundle\CyclewaysBundle\Manager\AbstractManager;

class PostManager extends AbstractManager
{
    /** @var PostRepository $postRepository */
    protected $postRepository = null;

    public function __construct($doctrine)
    {
        parent::__construct($doctrine);

        $this->postRepository = $this->doctrine->getRepository('CalderaBundle:Post');
    }

    public function getPostsForIncident(Incident $incident): array
    {
        return $this->postRepository->getPostsForIncident($incident);
    }
}