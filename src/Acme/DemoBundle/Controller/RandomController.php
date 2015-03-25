<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RandomController extends Controller
{
    public function indexAction($limit)
    {
        $number = rand(1, $limit);

        return $this->render('AcmeDemoBundle:Random:index.html.twig', array(
            'number' => $number,
        ));

        // Render a PHP template instead.
        // return new Response(
        //     '<html><body>Number: ' . rand(1, $limit) . '</body></html>'
        // );
    }
}