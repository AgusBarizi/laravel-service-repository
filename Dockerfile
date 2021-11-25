FROM php:7-fpm-alpine3.14
# Install extensions
RUN docker-php-ext-install pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN apk update && apk add supervisor nano
# COPY ./docker/supervisor/supervisord.conf /etc/supervisor/supervisord.conf
# COPY ./supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
# CMD ["/usr/bin/supervisord"]