**Test project for ClickHouse**

*Start*

`docker-compose -f .docker/docker-compose.yml  up -d`

Work container *php*

Generate migration for ClickHouse:

`bin/console doctrine:migration:generate --namespace=ClickHouseMigration`

