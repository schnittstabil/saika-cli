# Maintaining

## Build PHAR

```sh
docker run --rm -it -v $PWD:/app dockerstabil/box bash
composer update --ignore-platform-reqs
composer install --ignore-platform-reqs --no-dev
php build.php
exit
```
