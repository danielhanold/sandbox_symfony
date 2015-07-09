<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class LuckyController
{
    /**
     * Number action.
     *
     * @return Response
     */
    public function numberAction() {
        // Generate a random number between 0 and 100.
        $number = rand(0, 100);

        return new Response('<html><body>Lucky Number: ' . $number . '</body></html>');
    }

    /**
     * Lucky number for API endpoints.
     */
    public function apiNumberAction()
    {
        $data = array(
            'lucky_number' => rand(0, 100),
        );

        return new JsonResponse($data);
    }
}