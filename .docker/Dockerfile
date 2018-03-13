FROM php:7.1-apache

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
    && docker-php-ext-install \
        intl \
        mbstring \
        zip

# XDebug
RUN pecl install xdebug-2.5.5
RUN docker-php-ext-enable xdebug

ADD php.ini /usr/local/etc/php/
RUN usermod -u 1000 www-data

# Apache config
RUN a2enmod rewrite