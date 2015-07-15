<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    public function indexAction($page)
    {
        return $this->render('AppBundle:Blog:index.html.twig', array(
            'page' => $page
        ));
    }

    public function showAction($slug, $_route)
    {
        // Create an example link to page 2 of the blog listing.
        $url = $this->get('router')->generate('blog', array(
            'page' => 2,
            'category' => 'Symfony'
        ));
        var_dump('Generated URL: ' . $url);

        dump($this->get('router'));

        // Create an example link to another blog post.
        $url_other_post = $this->get('router')->generate('blog_show', array(
            'slug' => 'another-blog-post'
        ));
        var_dump('URI to other blog post: ' . $url_other_post);

        // Add some debug information.
        $current_url = $this->container->get('request_stack')->getCurrentRequest()->getUri();
        $current_uri = $this->container->get('request_stack')->getCurrentRequest()->getRequestUri();
        var_dump('Route: ' . $_route);
        var_dump('URI: ' . $current_uri);
        var_dump('Full URL: ' . $current_url);
        return new Response('<html><body>This is a blog page. Hello ' . $slug . '.</body></html>');
    }

    public function recentPostsAction()
    {
        // Fake-load a few articles from the database.
        $recentArticles = array();
        for ($i = 0; $i < 3; $i++) {
            $recentArticles[] = array(
                'title' => 'Post Number ' . $i,
                'slug' => 'article-' . $i,
            );
        }

        // Show articles in a template.
        return $this->render('AppBundle:Blog:recent_posts.html.twig', array(
            'posts' => $recentArticles,
        ));
    }
}