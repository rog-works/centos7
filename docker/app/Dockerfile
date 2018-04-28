FROM php:7.2.5-fpm-alpine3.7

ENV PHALCON_VERSION=3.3.2
ENV XDEBUG_VERSION=2.5.5

WORKDIR /var/www

RUN apk add --update --no-cache \
 # install dependencies
      make gcc g++ autoconf re2c file bzip2-dev dpkg dpkg-dev tzdata \
      libjpeg freetype-dev libpng-dev libjpeg-turbo-dev \
  && rm -rf /var/cache/apk/* \
 # install php-gd
 && docker-php-ext-configure gd \
      --with-freetype-dir=/usr/include/ \
      --with-png-dir=/usr/include/ \
      --with-jpeg-dir=/usr/include/ \
 && NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) \
 && docker-php-ext-install -j${NPROC} gd \
 # install php extensions
 && docker-php-ext-install \
      bz2 \
      calendar \
      mysqli \
      pcntl \
      pdo_mysql \
      shmop \
      sockets \
      sysvmsg \
      sysvsem \
      sysvshm \
 # install php-phalcon
 && mkdir -p /usr/src/php/ext \
 && cd /usr/src/php/ext \
 && curl -LO https://github.com/phalcon/cphalcon/archive/v${PHALCON_VERSION}.tar.gz \
 && tar xzf v${PHALCON_VERSION}.tar.gz \
 && cd /usr/src/php/ext/cphalcon-${PHALCON_VERSION}/build \
 && sh install \
 && echo "extension=phalcon.so" > /usr/local/etc/php/conf.d/phalcon.ini \
 && cd ~ \
 && rm -fr /usr/src/php \
 # install xdebug
 && pecl install xdebug-${XDEBUG_VERSION} \
 && touch /var/log/xdebug.log \
 && chmod 777 /var/log/xdebug.log \
 # set timezone
 && ln -sf /usr/share/zoneinfo/Asia/Tokyo /etc/localtime \
 && echo "Asia/Tokyo" > /etc/timezone \
 # uninstall build packages
 && apk del make gcc g++ \
 # changed UID/GID 
 && deluser www-data \
 && adduser -D -u www-data 1000

# install mail
RUN apk add --update --no-cache \
      ssmtp mailx \
 && rm -fr /var/cache/apk/*

# copy files
COPY etc/php.d/timezone.ini /usr/local/etc/php/conf.d/
COPY etc/php.d/xdebug.ini /usr/local/etc/php/conf.d/
COPY root/scripts /root/scripts
COPY etc/ssmtp/ssmtp.conf /etc/ssmtp/ssmtp.conf
