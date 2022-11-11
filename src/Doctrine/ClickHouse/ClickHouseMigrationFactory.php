<?php declare(strict_types=1);

namespace App\Doctrine\ClickHouse;

use Doctrine\DBAL\Connection;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\Migrations\Version\MigrationFactory;
use Psr\Log\LoggerInterface;

class ClickHouseMigrationFactory implements MigrationFactory
{
    private Connection $connection_mysql;

    private Connection $connection_clickHouse;

    private LoggerInterface $logger;

    /**
     * @param Connection      $connection_mysql
     * @param Connection      $connection_clickHouse
     * @param LoggerInterface $logger
     */
    public function __construct(
        Connection $connection_mysql,
        Connection $connection_clickHouse,
        LoggerInterface $logger
    ) {
        $this->connection_mysql      = $connection_mysql;
        $this->logger                = $logger;
        $this->connection_clickHouse = $connection_clickHouse;
    }

    /**
     * @return $this
     */
    public function __invoke(): self
    {
        return $this;
    }

    /**
     * @param string $migrationClassName
     *
     * @return AbstractMigration
     */
    public function createVersion(string $migrationClassName): AbstractMigration
    {
        if (str_contains($migrationClassName, 'ClickHouseMigration')) {

            return new $migrationClassName($this->connection_clickHouse, $this->logger);
        }

        return new $migrationClassName($this->connection_mysql, $this->logger);
    }
}
