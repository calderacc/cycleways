<?php

namespace Caldera\Bundle\CyclewaysBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FrontpageController extends AbstractController
{
    public function indexAction(Request $request): Response
    {
        return $this->render('CalderaCyclewaysBundle:Frontpage:index.html.twig');
    }
}
