<?php

namespace App\DataFixtures;

use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EventFixtures extends Fixture
{
    const COMPANIES     = ['test_comapany_1', 'test_comapany_2'];
    const NAMES         = ['game1', 'game2'];
    const ADSET         = ['qeqwe', 'qweqwe', 'qweqeqaeqew', 'qweqeqweq'];
    const CREATIVE_NAME = ['name1', 'name2', 'name3'];
    const PLATFORM      = ['ios', 'android'];
    const SITE_NAME     = ['itstm.com', 'facebook.by'];

    const COUNT = 100_000;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $count = 0;

        for ($i = 0; $i < self::COUNT; $i++) {
            $event = new Event();

            $event->setTime($faker->dateTimeBetween('-30 day', 'now'));
            $event->setName($faker->randomElement(self::NAMES));
            $event->setAdsSet($faker->randomElement(self::ADSET));
            $event->setCompanyName($faker->randomElement(self::COMPANIES));
            $event->setCreativeName($faker->randomElement(self::CREATIVE_NAME));
            $event->setPlatform($faker->randomElement(self::PLATFORM));
            $event->setSiteNane($faker->randomElement(self::SITE_NAME));

            $count++;
            $manager->persist($event);

            if ($count === 1_000) {
                $manager->flush();
                $manager->clear(Event::class);
                $count = 0;
            }
        }

        $manager->flush();
    }
}
