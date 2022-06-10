<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route (
     *     "/blog/{number<\d+>}",
     *     name = "blog_list",
     *     condition="params['number'] < 3",
     * )
     * @param $number
     * @return Response
     */
    public function numberShow($number): Response
    {
        return new Response("this is function will show number less than 3: $number");
    }

    /**
     * @Route (
     *     "/blog/{character}",
     *      name = "blog_show",
     * )
     * @param $character
     * @return Response
     */
    public function characterShow($character): Response
    {
        return new Response("this is function will show character or number more than 3: $character");
    }

    /**
     * @Route (
     *    "/blog/priority/{input}",
     *     name = "blog_priority",
     *     priority=99,
     *     condition="params['input']<9"
     * )
     * @param $input
     * @return Response
     */
    public function highPriority($input): Response
    {
        return new Response("this is function show high priority: $input");
    }

    /**
     * @Route (
     *    "/blog/priority/{input}",
     *     name = "blog_less",
     *     condition="params['input']<10"
     * )
     * @param $input
     * @return Response
     */
    public function lessPriority($input): Response
    {
        return new Response("this is function show less priority: $input");
    }
}
