FROM php:7.4-fpm

RUN apt-get -y update && apt-get -y install openssl libssl-dev libcurl4-openssl-dev wget zip zlib1g-dev libzip-dev libxml2-dev libssh-dev
RUN rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install curl bcmath zip iconv xml pdo pdo_mysql

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm -rf composer-setup.php && composer config --global repos.packagist composer https://packagist.org

WORKDIR /usr/share/nginx