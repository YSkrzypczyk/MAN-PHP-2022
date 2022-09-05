FROM php:8.0-apache

RUN docker-php-ext-install pdo mysqli pdo_mysql 

RUN apt-get update -y && apt-get install -y libpng-dev libfreetype6-dev libyaml-dev

RUN pecl install yamL

RUN usermod -u 1000 www-data

RUN a2enmod rewrite
