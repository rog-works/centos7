FROM php:7.2.2-fpm-alpine3.7

ENV PHALCON_VERSION=3.1.2

WORKDIR /usr/src/php/ext/

RUN apk add --update --no-cache \
# install dependecies
      make gcc g++ autoconf bzip2-dev tzdata \
      freetype-dev libpng-dev libjpeg-turbo-dev \
# install php-gd
 && docker-php-ext-configure gd \
      --with-freetype-dir=/usr/include/ \
      --with-png-dir=/usr/include/ \
      --with-jpeg-dir=/usr/include/ \
# install php-exts
 && docker-php-ext-install bz2 \
 && docker-php-ext-install calendar \
 && docker-php-ext-install mysqli \
 && docker-php-ext-install pcntl \
 && docker-php-ext-install pdo_mysql \
 && docker-php-ext-install shmop \
 && docker-php-ext-install sockets \
 && docker-php-ext-install sysvmsg \
 && docker-php-ext-install sysvsem \
 && docker-php-ext-install sysvshm \
 && rm -rf /var/cache/apk/* \
# set timezone
 && ln -sf /usr/share/zoneinfo/Asia/Tokyo /etc/localtime \
 && echo "Asia/Tokyo" > /etc/timezone \
# compile phalcon
 && set -xe \
 && curl -LO https://github.com/phalcon/cphalcon/archive/v${PHALCON_VERSION}.tar.gz \
 && tar xzf v${PHALCON_VERSION}.tar.gz \
 && cd cphalcon-${PHALCON_VERSION}/build && sh install \
 && echo "extension=phalcon.so" > /usr/local/etc/php/conf.d/phalcon.ini \
 && cd ../.. \
 && rm -rf v${PHALCON_VERSION}.tar.gz cphalcon-${PHALCON_VERSION}

WORKDIR /var/www
