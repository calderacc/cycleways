<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Incident;
use AppBundle\Entity\IncidentStatus;
use AppBundle\Entity\IncidentUser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

class IssuerController extends AbstractController
{
    public function renderAction(Request $request, Incident $incident): Response
    {
        $userList = $this->getDoctrine()->getRepository('AppBundle:User')->findAll();

        return $this->render('AppBundle:Issuer:list.html.twig', [
            'userList' => $userList,
            'incident' => $incident
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
