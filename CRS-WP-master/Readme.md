# Create new block
```shell
./gutenberg
npx create-guten-block crs-[block-name]
```
# Start docker
```shell
sudo service apache2 stop
docker-compose up --force-recreate
```
# Create dump DB
```shell
docker exec -it crs_mysql bash

mysqldump -p -u root wp > wp.sql
```
# Delete dump DB
```shell
docker rm -f $(docker ps -aq)

docker volume rm crs_db_data
```

# WP CLI
```shell
docker-compose run --rm wp-cli bash 
```