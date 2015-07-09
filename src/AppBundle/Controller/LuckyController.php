<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LuckyController extends Controller
{
    /**
     * Generate several numbers.
     *
     * @param $count
     * @return Response
     */
    public function numberAction($count)
    {
        $numbers = array();

        for ($i = 0; $i < $count; $i++) {
            $numbers[] = rand(0, 100);
        }

        // Convert array into string.
        $numbers_string = implode(', ', $numbers);

        /**
         * Replace this with the "render" shortcut below.
         */
        /*
        $html = $this->container->get('templating')->render(
            '@App/Lucky/number.html.twig',
            array('luckyNumberList' => $numbers_string)
        );
        return new Response($html);
         */

        return $this->render(
            '@App/Lucky/number.html.twig',
            array('luckyNumberList' => $numbers_string)
        );
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