<?php

namespace AppBundle\Manager\PostManager;

use AppBundle\Entity\Incident;
use AppBundle\Manager\AbstractManager;
use AppBundle\Repository\PostRepository;

class PostManager extends AbstractManager
{
    /** @var PostRepository $postRepository */
    protected $postRepository = null;

    public function __construct($doctrine)
    {
        parent::__construct($doctrine);

        $this->postRepository = $this->doctrine->getRepository('AppBundle:Post');
    }

    public function getPostsForIncident(Incident $incident): array
    {
        return $this->postRepository->getPostsForIncident($incident);
    }
}