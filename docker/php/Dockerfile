FROM php:8.2-fpm

RUN docker-php-ext-install pdo pdo_mysql

# $_ENV にdocker-compose.ymlのenvironmentが入るようにする
RUN echo "variables_order=EGPCS" > /usr/local/etc/php/conf.d/custom.ini

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
