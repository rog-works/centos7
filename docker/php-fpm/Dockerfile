FROM php:7.1-fpm-alpine3.4

ENV PHALCON_VERSION=3.1.2
ENV XDEBUG_VERSION=2.5.5

WORKDIR /var/www

RUN apk add --update --no-cache \
# install dependencies
      make gcc g++ autoconf re2c file bzip2-dev dpkg dpkg-dev tzdata \
      freetype-dev libpng-dev libjpeg-turbo-dev \
 && rm -rf /var/cache/apk/*

# install php extensions
RUN docker-php-ext-configure gd \
      --with-freetype-dir=/usr/include/ \
      --with-png-dir=/usr/include/ \
      --with-jpeg-dir=/usr/include/ \
 && docker-php-ext-install bz2 \
 && docker-php-ext-install calendar \
 && docker-php-ext-install mysqli \
 && docker-php-ext-install pcntl \
 && docker-php-ext-install pdo_mysql \
 && docker-php-ext-install shmop \
 && docker-php-ext-install sockets \
 && docker-php-ext-install sysvmsg \
 && docker-php-ext-install sysvsem \
 && docker-php-ext-install sysvshm

# XXX
COPY v3.1.2.tar.gz /usr/src/php/ext/

# install php-phalcon
RUN mkdir -p /usr/src/php/ext \
 && cd /usr/src/php/ext \
 # XXX && curl -LO https://github.com/phalcon/cphalcon/archive/v${PHALCON_VERSION}.tar.gz \
 && tar xzf v${PHALCON_VERSION}.tar.gz \
 && cd /usr/src/php/ext/cphalcon-${PHALCON_VERSION}/build \
 && sh install \
 && echo "extension=phalcon.so" > /usr/local/etc/php/conf.d/phalcon.ini \
 && cd ~ \
 && rm -fr /usr/src/php \
# set timezone
 && ln -sf /usr/share/zoneinfo/Asia/Tokyo /etc/localtime \
 && echo "Asia/Tokyo" > /etc/timezone

# install xdebug
RUN pecl install xdebug-${XDEBUG_VERSION}

RUN touch /var/log/xdebug.log \
 && chmod 777 /var/log/xdebug.log

# ini files
COPY etc/php.d/timezone.ini /usr/local/etc/php/conf.d/
COPY etc/php.d/xdebug.ini /usr/local/etc/php/conf.d/
