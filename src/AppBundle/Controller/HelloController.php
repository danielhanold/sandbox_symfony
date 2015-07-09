<?php

// Define namespace.
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;

class HelloController
{
    public function indexAction($firstName = 'No', $lastName = 'Name')
    {
        return new Response('<html><body>Hello ' . $firstName . ' ' . $lastName . '</body></html>');
    }
}