<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Config\Definition\Processor;
use Acme\DatabaseConfiguration;
use Symfony\Component\Config\FileLocator;

class LuckyController extends Controller
{
    /**
     * Configuration sandbox.
     */
    public function configAction() {
        // Get the root directory of the application.
        $rootDir = $this->container->getParameter('kernel.root_dir');

        // Get the directory that holds configurations.
        $configDirectories = array($rootDir . '/config');

        // Locate yaml configuration file.
        $locator = new FileLocator($configDirectories);
        $yamlConfigfiles = $locator->locate('config.yml', null, false);
        d($yamlConfigfiles);

        return new Response('Just a debug page');
    }

    /**
     * Generate several numbers.
     *
     * @param $count
     * @return Response
     */
    public function numberAction($count)
    {

        $numbers = array();

        for ($i = 0; $i < $count; $i++) {
            $numbers[] = rand(0, 100);
        }

        // Convert array into string.
        $numbers_string = implode(', ', $numbers);

        /**
         * Replace this with the "render" shortcut below.
         */
        /*
        $html = $this->container->get('templating')->render(
            '@App/Lucky/number.html.twig',
            array('luckyNumberList' => $numbers_string)
        );
        return new Response($html);
         */

        return $this->render("AppBundle:Lucky:number.html.twig", array(
            'luckyNumberList' => $numbers_string
        ));
    }

    /**
     * Lucky number for API endpoints.
     */
    public function apiNumberAction()
    {
        $data = array(
            'lucky_number' => rand(0, 100),
        );

        return new JsonResponse($data);
    }
}