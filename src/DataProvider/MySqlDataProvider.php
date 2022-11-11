<?php

namespace App\DataProvider;

use App\DataFixtures\EventFixtures;
use App\DTO\ChartDataDto;
use App\DTO\ChartDto;
use App\Repository\EventRepository;

class MySqlDataProvider
{
    private EventRepository $repo;

    public function __construct(EventRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param string $property
     *
     * @return array<ChartDataDto>
     */
    public function getData(string $property = 'name'): array
    {
        $qb = $this->repo->createQueryBuilder('ev');
        $qb
            ->select(sprintf("new %s(COUNT(ev.$property), ev.time)", ChartDataDto::class))
            ->andWhere('ev.companyName = :companyName')
            ->setParameter('companyName', EventFixtures::COMPANIES[0])
            ->orderBy('ev.time')
            ->groupBy('ev.time')
        ;

        return $qb->getQuery()->getArrayResult();
    }

    public function getChartData(string $property = 'name'): ChartDto
    {
        $labels = [];
        $data   = [];

        foreach ($this->getData($property) as $datum) {
            $labels[] = $datum->time;
            $data[]   = $datum->count;
        }

        return new ChartDto($labels, $data);
    }
}
