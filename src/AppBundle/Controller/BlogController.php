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

    public function showAction($slug)
    {
        return new Response('<html><body>This is a blog page. Hello ' . $slug . '.</body></html>');
    }
}