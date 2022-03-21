FROM php:8.0.16-fpm

# php.iniをコピー
# COPY ./docker/php/php.ini /usr/local/etc/php/php.ini
COPY ./docker/php/php.ini /usr/local/etc/php/8.0

# Composer install
COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

#node.js install
COPY --from=node:10.22 /usr/local/bin /usr/local/bin
COPY --from=node:10.22 /usr/local/lib /usr/local/lib

RUN apt-get update \
    && apt-get install -y \
    git \
    zip \
    unzip \
    vim \
    && docker-php-ext-install pdo_mysql bcmath sockets

WORKDIR /var/www/html