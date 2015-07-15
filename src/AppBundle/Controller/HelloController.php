<?php

// Define namespace.
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

class HelloController extends Controller
{
    public function indexAction($firstName = 'No', $lastName = 'Name', Request $request)
    {
        return new Response('<html><body>Hello ' . $firstName . ' ' . $lastName . '</body></html>');
    }

    public function redirectAction()
    {
        //return $this->redirectToRoute('hello');
        return new RedirectResponse($this->generateUrl('lucky_number') . '/6');
    }

    public function redirectExternalAction()
    {
        return $this->redirect('http://www.spiegel.de');
    }

    public function exampleErrorAction($responseCode = 500)
    {
        switch ($responseCode) {
            case 404:
                throw $this->createNotFoundException('This is a great example for a 404 error');
                break;

            case 500:
            default:
                throw new \Exception('Something went wrong');
            break;
        }
    }
}