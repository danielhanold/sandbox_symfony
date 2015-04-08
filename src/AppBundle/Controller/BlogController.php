<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    public function indexAction()
    {
        return new Response('<html><body>This is the index page for the blog. Imagine a list of blog posts.</body></html>');
    }

    public function showAction($slug)
    {
        return new Response('<html><body>Hello ' . $slug . '</body></html>');
    }
}