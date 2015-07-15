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
        $session = $request->getSession();

        // Get the foo variable, use a default variable in case it doesn't exist.
        // This will be empty on the first page load and set in a consecutive one.
        $tempSessionVar = $session->get('foo', 'no name set yet');

        // Story an attribute for reuse later.
        $session->set('foo', 'danny test');

        // Get an attribute set by another controller in another request.
        $foobar = $session->get('foobar');

        return new Response('<html><body>Hello ' . $firstName . ' ' . $lastName . '.<br />A temporary variable is: ' . $tempSessionVar . '</body></html>');
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