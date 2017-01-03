<?php

namespace Caldera\Bundle\CyclewaysBundle\Controller;

use Caldera\Bundle\CyclewaysBundle\Entity\City;
use Caldera\Bundle\CyclewaysBundle\Entity\Incident;
use Caldera\Bundle\CyclewaysBundle\Form\Type\IncidentType;
use Caldera\Bundle\CyclewaysBundle\SlugGenerator\SlugGenerator;
use Caldera\GeoBasic\Coord\Coord;
use Curl\Curl;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class IncidentController extends AbstractController
{
    public function mapAction(Request $request, $citySlug): Response
    {
        $city = $this->getCityBySlug($citySlug);

        return $this->render(
            'CalderaCyclewaysBundle:Incident:map.html.twig',
            [
                'city' => $city
            ]
        );
    }

    public function loadAction(Request $request): Response
    {
        if (
            !$request->request->get('northWestLatitude') ||
            !$request->request->get('northWestLongitude') ||
            !$request->request->get('southEastLatitude') ||
            !$request->request->get('southEastLongitude')
        ) {
            throw $this->createNotFoundException();
        }

        $northWest = new Coord(
            $request->request->get('northWestLatitude'),
            $request->request->get('northWestLongitude')
        );
        
        $southEast = new Coord(
            $request->request->get('southEastLatitude'),
            $request->request->get('southEastLongitude')
        );

        if ($request->request->get('knownIndizes') && is_array($request->request->get('knownIndizes'))) {
            $knownIndizes = $request->request->get('knownIndizes');
        } else {
            $knownIndizes = [];
        }
        
        $bounds = new Bounds($northWest, $southEast);
        
        $results = $this->getIncidentManager()->getIncidentsInBounds($bounds, $knownIndizes);

        $serializer = $this->get('jms_serializer');
        $serializedData = $serializer->serialize($results, 'json');

        return new Response($serializedData);
    }

    public function addAction(Request $request, $citySlug)
    {
        $city = $this->getCityBySlug($citySlug);

        $incident = new Incident();
        $incident->setUser($this->getUser());
        $incident->setCity($city);

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
        );

        if ('POST' == $request->getMethod()) {
            return $this->addPostAction($request, $incident, $city, $form);
        } else {
            return $this->addGetAction($request, $incident, $city, $form);
        }
    }

    public function addGetAction(Request $request, Incident $incident, City $city, Form $form): Response
    {
        return $this->render(
            'CalderaCyclewaysBundle:Incident:edit.html.twig',
            [
                'incident' => null,
                'city' => $city,
                'form' => $form->createView()
            ]
        );
    }

    public function addPostAction(Request $request, Incident $incident, City $city, Form $form)
    {
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $incident->setCity($city);
            
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
            'CalderaCyclewaysBundle:Incident:edit.html.twig',
            array(
                'incident' => $incident,
                'form' => $form->createView(),
                'city' => $city
            )
        );
    }

    public function showAction(Request $request, string $slug): Response
    {
        /** @var Incident $incident */
        $incident = $this->getIncidentRepository()->findOneBySlug($slug);

        if (!$incident) {
            throw $this->createNotFoundException();
        }

        $posts = $this->getPostManager()->getPostsForIncident($incident);
        $photos = $this->getPhotoRepository()->findByIncident($incident);

        $this->storeView($incident);

        /*$this->getMetadata()
            ->setTitle($this->generatePageTitle($incident))
            ->setDescription($incident->getDescription());
*/
        return $this->render(
            'CalderaCyclewaysBundle:Incident:show.html.twig',
            [
                'incident' => $incident,
                'posts' => $posts,
                'photos' => $photos

            ]
        );
    }
    
    public function listAction(Request $request, string $citySlug): Response
    {
        $city = $this->getCityBySlug($citySlug);

        $incidents = $this->getIncidentManager()->getIncidentsForCity($city);

        return $this->render(
            'CalderaCyclewaysBundle:Incident:list.html.twig',
            [
                'incidents' => $incidents,
                'city' => $city
            ]
        );
    }

    protected function generatePageTitle(Incident $incident): string
    {
        $title = $incident->getTitle();
        $title .= ' &mdash; ' . $incident->getStreet() . ', ' . $incident->getCity()->getCity();
        $title .= ' &mdash; Cycleways.info';

        return $title;
    }

    protected function storeView(Incident $incident)
    {
        $viewStorage = $this->get('caldera.view_storage.cache');

        $viewStorage->countView($incident);
    }

    public function googleMapsCoordAction(Request $request): JsonResponse
    {
        $googleLocation = $request->query->get('googleUrl');

        if (!$googleLocation) {
            return new JsonResponse([]);
        }

        $curl = new Curl();
        $curl->get($googleLocation);

        if ($curl->responseHeaders['location'] && $curl->responseHeaders['status-line'] == 'HTTP/1.1 301 Moved Permanently') {
            $googleLocation = $curl->responseHeaders['location'];
        }

        $regex = '/@([0-9]{1,2}\.[0-9]*),([0-9]{1,2}\.[0-9]*)/';

        preg_match($regex, $googleLocation, $matches);

        $resultArray = [
            'latitude' => $matches[1],
            'longitude' => $matches[2]
        ];

        return new JsonResponse($resultArray);
    }

    public function addresslookupAction(Request $request): JsonResponse
    {
        $latitude = $request->query->get('lat');
        $longitude = $request->query->get('lng');

        $nominatim = 'https://nominatim.openstreetmap.org/reverse?lat=' . $latitude . '&lon=' . $longitude .'&format=json';

        $curl = new Curl();
        $curl->get($nominatim);

        var_dump($curl->response);

        return new JsonResponse([]);
    }
}
