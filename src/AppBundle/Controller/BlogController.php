<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    public function showAction($slug)
    {
        return new Response('<html><body>Hello ' . $slug . '</body></html>');
    }
}