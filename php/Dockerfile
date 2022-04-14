FROM php:8.1-fpm
RUN pecl install xdebug && docker-php-ext-enable xdebug && \
docker-php-ext-install pdo_mysql

COPY ./php.ini /usr/local/etc/php/php.ini
COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

