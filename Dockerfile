FROM php:8.4-fpm-bookworm

RUN apt-get update \
    && apt-get install -y --no-install-recommends git unzip libicu-dev libsqlite3-dev libzip-dev \
    && docker-php-ext-install -j"$(nproc)" intl pdo_mysql pdo_sqlite zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY docker/php/entrypoint.sh /usr/local/bin/expert-hub-entrypoint
RUN chmod +x /usr/local/bin/expert-hub-entrypoint

ENTRYPOINT ["expert-hub-entrypoint"]
CMD ["php-fpm"]
