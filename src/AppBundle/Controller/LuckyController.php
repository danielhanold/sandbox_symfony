<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class LuckyController
{
    /**
     * Generate several numbers.
     *
     * @param $count
     * @return Response
     */
    public function numberAction($count) {
        $numbers = array();

        for ($i = 0; $i < $count; $i++) {
            $numbers[] = rand(0, 100);
        }

        // Convert array into string.
        $numbers_string = implode(', ', $numbers);

        return new Response('<html><body>Lucky Number: ' . $numbers_string. '</body></html>');
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