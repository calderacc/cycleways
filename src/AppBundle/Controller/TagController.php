<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Incident;
use AppBundle\Entity\IncidentStatus;
use AppBundle\Entity\IncidentTag;
use AppBundle\Entity\IncidentUser;
use AppBundle\Entity\Tag;
use AppBundle\Entity\User;
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
        $tagIdList = $request->request->get('tagList', []);

        /** @var Incident $incident */
        $incident = $this->getIncidentRepository()->findOneBySlug($slug);

        /** @var IncidentTag[] $incidentTags */
        $incidentTags = $this->getDoctrine()->getRepository('AppBundle:IncidentTag')->findForIncident($incident);

        foreach ($incidentTags as $incidentTag) {
            $tagId = $incidentTag->getTag()->getId();

            if  (!in_array($tagId, $tagIdList)) {
                $this->removeIncidentTag($incidentTag, $user);

                $key = array_search($tagId, $tagIdList);
                unset($tagIdList[$key]);
            }
        }

        foreach ($tagIdList as $tagId) {
            $tag = $this->getDoctrine()->getRepository('AppBundle:Tag')->find($tagId);

            $this->createIndidentTag($incident, $tag, $user);
        }

        $this->getDoctrine()->getManager()->flush();

        return new Response();
    }

    protected function createIndidentTag(Incident $incident, Tag $tag, User $user): IncidentTag
    {
        $incidentTag = new IncidentTag();

        $incidentTag
            ->setIncident($incident)
            ->setUser($user)
            ->setTag($tag)
        ;

        $incident->addIncidentTag($incidentTag);

        $this->getDoctrine()->getManager()->persist($incidentTag);

        return $incidentTag;
    }

    protected function removeIncidentTag(IncidentTag $incidentTag, User $user): void
    {
        $incidentTag->setDateTimeRemoved(new \DateTime());
    }
}
