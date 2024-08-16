FROM php:8.3-fpm

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update && apt-get install -y unzip
RUN docker-php-ext-install pdo_mysql
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
RUN apt-get install -y nodejs
RUN apt-get install -y git

RUN if [ ${ENABLE_DEBUG} = true ]; then \
    pecl install xdebug-3.3.1 && docker-php-ext-enable xdebug \
        && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.remote_handler=dbgp" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.discover_client_host=0" >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.client_host="${XDEBUG_CLIEN_HOST} >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.client_port="${XDEBUG_CLIEN_PORT} >> /usr/local/etc/php/conf.d/xdebug.ini \
        && echo "xdebug.idekey="${XDEBUG_IDE_KEY} >> /usr/local/etc/php/conf.d/xdebug.ini \
;fi

WORKDIR /var/www/app
