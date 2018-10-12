FROM php:5.6-apache

RUN apt-get update -y && apt-get install -y libpng-dev curl libcurl4-openssl-dev libmemcached-dev libgeoip-dev wget

RUN docker-php-ext-install gd curl mysql mysqli

RUN printf "\n" | pecl install memcached-2.2.0 geoip
RUN echo "extension=memcached.so" > /usr/local/etc/php/conf.d/docker-php-ext-memcached.ini
RUN echo "extension=geoip.so" > /usr/local/etc/php/conf.d/docker-php-ext-geoip.ini

RUN a2enmod rewrite
RUN service apache2 restart