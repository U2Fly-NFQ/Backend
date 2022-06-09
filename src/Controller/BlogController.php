<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route (
     *     "/blog/{page}",
     *     name = "blog_list",
     *     condition="params['page'] < 2",
     *     requirements={"page"="\d+"< 2},
     * )
     * @param  $page
     * @return Response
     */
    public function list($page): Response
    {
        return new Response("this is list function, list page: $page");
    }

    /**
     * @Route (
     *     "/blog/{slug}",
     *      name = "blog_show",
     * )
     * @param $slug
     * @return Response
     */
    public function show($slug): Response
    {
        return new Response("this is show function, slug: $slug");
    }
}