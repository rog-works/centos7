FROM centos:6.9

ENV PHP_VERSION 5.3.3
ENV HTTPD_VERSION 2.2.15
ENV XDEBUG_VERSION 2.2.7

WORKDIR /var/www

RUN yum update -y \
 && yum install -y \
      php-${PHP_VERSION} \
      php-devel \
      php-pear \
      php-mysql \
      gcc \
      make \
      httpd-${HTTPD_VERSION} \
 && pecl install xdebug-${XDEBUG_VERSION} \
 && touch /var/log/httpd/access_log \
 && touch /var/log/httpd/error_log \
 && touch /var/log/xdebug.log

COPY ./entrypoint.sh /
COPY ./etc/httpd/conf/httpd.conf /etc/httpd/conf/
COPY ./etc/httpd/conf.d /etc/httpd/conf.d
COPY ./etc/php.d/xdebug.ini /etc/php.d/xdebug.ini
COPY ./etc/php.d/timezone.ini /etc/php.d/timezone.ini

ENTRYPOINT [ "/entrypoint.sh" ]
