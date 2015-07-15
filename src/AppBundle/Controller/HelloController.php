<?php

// Define namespace.
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HelloController extends Controller
{
    public function indexAction($firstName = 'No', $lastName = 'Name', Request $request)
    {
        return new Response('<html><body>Hello ' . $firstName . ' ' . $lastName . '</body></html>');
    }

    public function redirectAction()
    {
        return $this->redirectToRoute('hello');
    }

    public function redirectExternalAction()
    {
        return $this->redirect('http://www.spiegel.de');
    }
}