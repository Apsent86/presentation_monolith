<?php

namespace App\DataFixtures;

use App\Doctrine\ClickHouse\Insert;
use App\Entity\ClickHouse\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use FOD\DBALClickHouse\Connection;

class ClickHouseEventFixtures extends Fixture
{
    use Insert;

    const COMPANIES     = ['test_comapany_1', 'test_comapany_2'];
    const NAMES         = ['game1', 'game2'];
    const ADSET         = ['qeqwe', 'qweqwe', 'qweqeqaeqew', 'qweqeqweq'];
    const CREATIVE_NAME = ['name1', 'name2', 'name3'];
    const PLATFORM      = ['ios', 'android'];
    const SITE_NAME     = ['itstm.com', 'facebook.by'];

    const COUNT = 100_000;

    private Connection $connection;

    /**
     * @param Connection $connection_clickHouse
     */
    public function __construct(Connection $connection_clickHouse)
    {
        $this->connection = $connection_clickHouse;
    }


    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $count = 0;

        $events = [];

        for ($i = 0; $i < self::COUNT; $i++) {
            $event = new Event();

            $event->time        = $faker->dateTimeBetween('-30 day', 'now')->format('Y-m-d');
            $event->name        = $faker->randomElement(self::NAMES);
            $event->adsSet      = $faker->randomElement(self::ADSET);
            $event->companyName = $faker->randomElement(self::COMPANIES);
            $event->platform    = $faker->randomElement(self::PLATFORM);
            $event->siteNane    = $faker->randomElement(self::SITE_NAME);

            $count++;

            $events[] = json_encode($event);

            if ($count === 1_000) {
                $this->insertJsonRows('clickhouse_event', $events);
                $count  = 0;
                $events = [];
            }
        }
    }
}
