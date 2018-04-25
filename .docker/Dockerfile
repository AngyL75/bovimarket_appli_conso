# See https://hub.docker.com/_/php
FROM php:7.0-apache

RUN apt-get update && apt-get install -y git

# PHP extensions
RUN buildDeps=" \
        libicu-dev \
        zlib1g-dev \
    " \
    && apt-get install -y --no-install-recommends \
        $buildDeps \
        libicu52 \
        zlib1g \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure \
        intl \
    && docker-php-ext-install \
        intl \
        mbstring \
        zip \
    && pecl install \
        xdebug \
    && pecl clear-cache \
    && docker-php-ext-enable --ini-name 20-xdebug.ini xdebug

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY php.ini /usr/local/etc/php/php.ini

# https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer global require "hirak/prestissimo:^0.3" --prefer-dist --no-progress --no-suggest --classmap-authoritative \
	&& composer clear-cache
ENV PATH="${PATH}:/root/.composer/vendor/bin"

RUN usermod -u 1000 www-data

# Apache config
RUN a2enmod rewrite