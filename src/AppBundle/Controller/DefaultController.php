<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Product;
use AppBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/app/example", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * Create a product.
     */
    public function createAction()
    {
        $product = new Product();
        $product->setName('A Foo Bar');
        $product->setPrice('19.99');
        $product->setDescription('Lorem ipsum dolor');

        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();

        return new Response('Created product id ' . $product->getId());
    }

    /**
     * Create a more advanced product with a category.
     */
    public function createProductAction()
    {
        $category = new Category();
        $category->setName('Main Products');

        $product = new Product();
        $product->setName('Foo Product ' . time());
        $product->setPrice(19.99);
        $product->setDescription('Lorem ipsum');

        // Relate this product to a category.
        $product->setCategory($category);

        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->persist($product);
        $em->flush();

        return new Response('Created product id: ' . $product->getId() . ' and category id: ' . $category->getId());
    }

    /**
     * Load a product.
     */
    public function showAction($id)
    {
        $product = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id
            );
        }

        // Print out the complete object.
        // d($product);

        return new Response('Found a product for id ' . $id . '. The product is called: ' . $product->getName());
    }

    /**
     * Update a product.
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AppBundle:Product')->find($id);

        if (!$product) {
            throw $this->createNotFoundException('No product found for id ' . $id);
        }

        // Update product with new name.
        $product->setName('New product name!');
        $em->flush();

        return $this->redirectToRoute('homepage');
    }

    /**
     * Use the query builder to get results.
     */
    public function queryBuilderAction()
    {

        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AppBundle:Product');

        $query = $repository->createQueryBuilder('p')
            ->where('p.price > :price')
            ->setParameter('price', '19.98')
            ->orderBy('p.price', 'ASC')
            ->getQuery();

        $products = $query->getResult();
        d($products);

        return new Response('I did something');
    }

    /**
     * Use the DQL instead of using the query builder.
     */
    public function queryBuilderDqlAction()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT p FROM AppBundle:Product p WHERE p.price > :price ORDER BY p.price ASC'
        )->setParameter('price', '19.98');
        $products = $query->getResult();

        // Debug-print products:
        d($products);

        return new Response('I made it until the end');
    }

    /**
     * Use repository class to return results.
     */
    public function queryRepositoryClassAction()
    {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('AppBundle:Product')->findAllOrderedByName();
        d($products);

        return new Response(sprintf('Success! I found %d results', count($products)));
    }
}