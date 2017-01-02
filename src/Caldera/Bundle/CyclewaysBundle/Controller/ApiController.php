<?php

namespace Caldera\Bundle\CyclewaysBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends AbstractController
{
    public function apiAction(Request $request): JsonResponse
    {
        return new JsonResponse();
    }
}
