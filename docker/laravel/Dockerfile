FROM php:7.4-fpm
COPY php.ini /usr/local/etc/php/

RUN apt update \
  && apt-get install -y zlib1g-dev mariadb-client libzip-dev \
  && docker-php-ext-install zip pdo_mysql

#Composer install
COPY --from=composer /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1

ENV COMPOSER_HOME /composer

RUN composer global require laravel/installer

ENV PATH $PATH:/composer/vendor/bin

WORKDIR /var/www/
