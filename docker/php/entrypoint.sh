#!/bin/sh
set -eu

if [ ! -f .env ]; then
    cp .env.example .env
fi

if [ ! -f vendor/autoload.php ]; then
    composer install --no-interaction --prefer-dist
fi

mkdir -p \
    storage/framework/cache/data \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

touch storage/logs/laravel.log

chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
exec "$@"
