<?php

namespace Dna\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('DnaTestBundle:Default:index.html.twig', array('name' => $name));
    }
}
