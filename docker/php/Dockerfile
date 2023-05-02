FROM php:8.1-apache

# COPY php.ini
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini

COPY ./docker/apache/httpd.conf /etc/apache2/sites-available/000-default.conf

RUN  a2enmod rewrite

# Composer install
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

RUN apt-get update && \
    apt-get -y install \
    git \
    zip \
    unzip \
    vim \
    && docker-php-ext-install pdo_mysql bcmath

WORKDIR /var/www/html
