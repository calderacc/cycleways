<?php

namespace AppBundle\Controller;

use Curl\Curl;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class InternalController extends AbstractController
{
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
}