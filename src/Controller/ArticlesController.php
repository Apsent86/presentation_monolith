<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    #[Route(path: '/home', name: 'home', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('mysql/index.html.twig');
    }

    #[Route(path: '/clickhouse', name: 'clickhouse', methods: ['GET'])]
    public function clickhouse(): Response
    {
        return $this->render('clickhouse/index.html.twig');
    }
}
