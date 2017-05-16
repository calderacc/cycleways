<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Incident;
use AppBundle\Entity\IncidentStatus;
use AppBundle\Entity\IncidentTag;
use AppBundle\Entity\IncidentUser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

class TagController extends AbstractController
{
    public function renderAction(Request $request, Incident $incident): Response
    {
        $tagList = $this->getDoctrine()->getRepository('AppBundle:Tag')->findAll();
        $incidentTags = $this->getDoctrine()->getRepository('AppBundle:Tag')->findTagsForIncident($incident);

        return $this->render('AppBundle:Tag:list.html.twig', [
            'tagList' => $tagList,
            'incident' => $incident,
            'incidentTagList' => $incidentTags,
        ]);
    }

    public function updateAction(Request $request, string $slug, UserInterface $user): Response
    {
        $tagId = $request->request->getInt('tagId');

        /** @var Incident $incident */
        $incident = $this->getIncidentRepository()->findOneBySlug($slug);

        $tag = $this->getDoctrine()->getRepository('AppBundle:Tag')->find($tagId);

        $incidentTag = new IncidentTag();

        $incidentTag
            ->setIncident($incident)
            ->setUser($user)
            ->setTag($tag)
        ;

        $incident->addIncidentTag($incidentTag);

        $this->getDoctrine()->getManager()->persist($incidentTag);
        $this->getDoctrine()->getManager()->flush();

        return new Response();
    }
}
