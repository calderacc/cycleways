<?php

namespace AppBundle\Controller\Incident;

use AppBundle\Controller\AbstractController;
use AppBundle\Entity\Incident;
use AppBundle\Form\Type\IncidentType;
use AppBundle\SlugGenerator\SlugGenerator;
use Curl\Curl;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ManagementController extends AbstractController
{
    public function addAction(Request $request)
    {
        $incident = new Incident();
        $incident->setUser($this->getUser());

        $form = $this->createForm(
            IncidentType::class,
            $incident,
            [
                'action' => $this->generateUrl('caldera_cycleways_incident_add')
            ]
        );

        if ('POST' == $request->getMethod()) {
            return $this->addPostAction($request, $incident, $form);
        } else {
            return $this->addGetAction($request, $incident, $form);
        }
    }

    public function addGetAction(Request $request, Incident $incident, Form $form): Response
    {
        return $this->render(
            'AppBundle:Incident:edit.html.twig',
            [
                'incident' => null,
                'form' => $form->createView()
            ]
        );
    }

    public function addPostAction(Request $request, Incident $incident, Form $form)
    {
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            // first persist incident to create an id
            $em->persist($incident);
            $em->flush();

            // now use id
            $slugGenerator = new SlugGenerator();
            $slug = $slugGenerator->generateSlug($incident);

            $this->get('caldera.cycleways.permalink_manager.sqibe')->createPermalink($incident);

            // now save incident with slugged id
            $em->persist($incident);
            $em->flush();

            return $this->redirectToRoute('caldera_cycleways_incident_show', ['slug' => $slug]);
            /*
            $form = $this->createForm(
                IncidentType::class,
                $incident,
                [
                    'action' => $this->generateUrl(
                        'caldera_cycleways_incident_add',
                        [
                            'citySlug' => $city->getSlug()
                        ]
                    )
                ]
            );*/
        }

        return $this->render(
            'AppBundle:Incident:edit.html.twig',
            array(
                'incident' => $incident,
                'form' => $form->createView()
            )
        );
    }

    protected function generatePageTitle(Incident $incident): string
    {
        $title = $incident->getTitle();
        $title .= ' &mdash; ' . $incident->getStreet() . ', ' . $incident->getCity()->getCity();
        $title .= ' &mdash; Cycleways.info';

        return $title;
    }
}
