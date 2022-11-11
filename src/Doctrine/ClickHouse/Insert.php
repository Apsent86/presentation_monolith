<?php

namespace App\Doctrine\ClickHouse;

trait Insert
{
    /**
     * @param string       $tableExpression
     * @param array<array> $data
     *
     * @return int
     */
    public function insertMultiple(string $tableExpression, array $data): int
    {
        $values = [];
        $params = [];

        foreach ($data as $index => $array) {
            $values[] = '('.\implode(', ', \array_fill(0, \count($array), '?')).')';
            foreach ($array as $value) {
                $params[] = \is_string($value) ? \str_replace('?', '', $value) : $value;
            }
        }

        $first = \reset($data);
        $sql   = 'INSERT INTO '.$tableExpression.' ('.\implode(', ', \array_keys($first)).') VALUES '
            .\implode(', ', $values);

        return $this->connection->executeUpdate($sql, $params);
    }

    /**
     * @param string        $table
     * @param null|string[] $jsons
     *
     *
     * @return int
     */
    public function insertJsonRows(string $table, ?array $jsons): int
    {
        if (null === $jsons) {
            return 0;
        }

        return $this->connection->executeStatement("INSERT INTO {$table} FORMAT JSONEachRow ".\implode(' ', $jsons));
    }

}
