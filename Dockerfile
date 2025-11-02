FROM php:7.4-apache

RUN apt-get update && apt-get install -y \
    libpq-dev \
    gcc \
    make \
    autoconf \
 && docker-php-ext-install pdo pdo_pgsql \
 && apt-get clean \
 && rm -rf /var/lib/apt/lists/*

COPY . /var/www/html


WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html

RUN a2enmod rewrite

EXPOSE 80
