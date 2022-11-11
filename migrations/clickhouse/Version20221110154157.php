<?php

declare(strict_types=1);

namespace ClickHouseMigration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221110154157 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $toSchema = clone $schema;

        $newTable = $toSchema->createTable('clickhouse_event');

        $newTable->addColumn('time', 'date', ['notnull' => false,]);
        $newTable->addColumn('name', 'string', ['notnull' => false, 'length' => 255,]);
        $newTable->addColumn('companyName', 'string', ['notnull' => false, 'length' => 255,]);
        $newTable->addColumn('platform', 'string', ['notnull' => false, 'length' => 255,]);
        $newTable->addColumn('siteNane', 'string', ['notnull' => false, 'length' => 255,]);
        $newTable->addColumn('adsSet', 'string', ['notnull' => false, 'length' => 255,]);

        $newTable->addOption('eventDateColumn', 'time');
        $newTable->addOption('engine', 'MergeTree');

        $newTable->setPrimaryKey(['time', 'name', 'companyName', 'platform', 'siteNane']);
        $newTable->addOption('ORDER BY', 'time, name, companyName, platform, siteNane');

        $sqlArray = $schema->getMigrateToSql($toSchema, $this->platform);
        foreach ($sqlArray as $sql) {
            $this->connection->exec($sql);
        }
    }

    public function down(Schema $schema): void
    {
        $this->connection->exec('DROP TABLE clickhouse_event');
    }
}
