<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Incident;
use AppBundle\Entity\IncidentStatus;
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
        $userId = $request->request->getInt('userId');

        /** @var Incident $incident */
        $incident = $this->getIncidentRepository()->findOneBySlug($slug);

        $user = $this->getDoctrine()->getRepository('AppBundle:User')->find($userId);

        $issuer = new IncidentUser();

        $issuer
            ->setIncident($incident)
            ->setUser($user)
        ;

        $incident->setIssuer($issuer);

        $this->getDoctrine()->getManager()->persist($issuer);
        $this->getDoctrine()->getManager()->flush();

        return new Response();
    }
}
