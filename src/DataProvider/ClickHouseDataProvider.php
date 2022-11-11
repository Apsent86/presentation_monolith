<?php

namespace App\DataProvider;

use App\DataFixtures\EventFixtures;
use App\DTO\ChartDataDto;
use App\DTO\ChartDto;
use Doctrine\DBAL\Driver\Exception;
use FOD\DBALClickHouse\Connection;

class ClickHouseDataProvider
{
    private Connection $connection;

    /**
     * @param Connection $connection_clickHouse
     */
    public function __construct(Connection $connection_clickHouse)
    {
        $this->connection = $connection_clickHouse;
    }

    /**
     * @param string $property
     *
     * @return array<ChartDataDto>
     * @throws Exception
     * @throws \Doctrine\DBAL\Exception
     */
    public function getData(string $property = 'name'): array
    {
        $qb = $this->connection->createQueryBuilder();
        $qb
            ->select("COUNT(ev.$property) count, ev.time time")
            ->from('clickhouse_event', 'ev')
            ->andWhere('ev.companyName = :companyName')
            ->setParameter('companyName', EventFixtures::COMPANIES[0])
            ->orderBy('ev.time')
            ->groupBy('ev.time')
        ;

        return $qb->execute()->fetchAllAssociative();
    }

    public function getChartData(string $property = 'name'): ChartDto
    {
        $labels = [];
        $data   = [];

        foreach ($this->getData($property) as $datum) {

            $labels[] = $datum['time'];
            $data[]   = $datum['count'];
        }

        return new ChartDto($labels, $data);
    }
}
