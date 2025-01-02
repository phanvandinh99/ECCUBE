docker-compose -f docker-compose.yml -f docker-compose.pgsql.yml -f docker-compose.dev.yml up -d

docker exec -it c594ca84bcdc psql -U dbuser

bin/console eccube:generate:proxies

php bin/console cache:clear
