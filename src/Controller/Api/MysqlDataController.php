<?php

namespace App\Controller\Api;

use App\DataProvider\ClickHouseDataProvider;
use App\DataProvider\MySqlDataProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/api')]
class MysqlDataController extends AbstractController
{
    #[Route(path: '/mysql', name: 'api_mysql', methods: ['GET'])]
    public function mysql(MySqlDataProvider $dataProvider): Response
    {
        $data = $dataProvider->getChartData();

        return new JsonResponse($data);
    }

    #[Route(path: '/clickhouse', name: 'api_clickhouse', methods: ['GET'])]
    public function listClickhouse(ClickHouseDataProvider $dataProvider): Response
    {
        $data = $dataProvider->getChartData();

        return new JsonResponse($data);
    }
}
