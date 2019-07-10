FROM php:7.2-fpm
WORKDIR /home/shop

RUN apt-get -y update && apt-get -y install git unzip nano vim supervisor locales gettext-base \
 mysql-client curl libmcrypt-dev librabbitmq-dev && apt-get clean
RUN docker-php-ext-install pdo pdo_mysql

RUN yes | pecl install xdebug \
    docker-php-ext-enable xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini


EXPOSE 80 443 9000
