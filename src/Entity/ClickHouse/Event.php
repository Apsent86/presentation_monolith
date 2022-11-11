<?php

namespace App\Entity\ClickHouse;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Table('clickhouse_event')]
class Event
{
    #[ORM\Column(type: 'string', length: 255)]
    public ?string $name;

    #[ORM\Column(type: 'string', length: 255)]
    public ?string $companyName;

    #[ORM\Column(type: 'string', length: 255)]
    public ?string $platform;

    #[ORM\Column(type: 'string', length: 255)]
    public ?string $siteNane;

    #[ORM\Column(type: 'string', length: 255)]
    public ?string $adsSet;

    #[ORM\Column(type: 'date')]
    public $time;
}
