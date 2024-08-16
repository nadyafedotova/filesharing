FROM php:8.2.8-fpm

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update && apt-get install -y unzip
RUN docker-php-ext-install pdo_mysql
RUN curl -fsSL https://deb.nodesource.com/setup_19.x | bash -
RUN apt-get install -y nodejs
RUN apt-get install -y git

WORKDIR /var/www/app
