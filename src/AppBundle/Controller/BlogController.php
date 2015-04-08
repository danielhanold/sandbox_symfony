<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    public function indexAction($page)
    {
        return new Response('<html><body>This is the index page for the blog. Imagine a list of blog posts.<br />The page is ' . $page . '</body></html>');
    }

    public function showAction($slug, $_route)
    {
        // Add some debug information.
        $url = $this->container->get('request_stack')->getCurrentRequest()->getUri();
        $uri = $this->container->get('request_stack')->getCurrentRequest()->getRequestUri();
        var_dump('Route: ' . $_route);
        var_dump('URI: ' . $uri);
        var_dump('Full URL: ' . $url);
        return new Response('<html><body>This is a blog page. Hello ' . $slug . '.</body></html>');
    }
}