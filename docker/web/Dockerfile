FROM centos:6.9

ENV PHP_VERSION 5.3.3
ENV HTTPD_VERSION 2.2.15

WORKDIR /var/www

RUN yum update -y \
 && yum install -y \
      php-${PHP_VERSION} \
      php-mysql \
      httpd-${HTTPD_VERSION} \
 && touch /var/log/httpd/access_log \
 && touch /var/log/httpd/error_log

COPY ./entrypoint.sh /
COPY ./etc/httpd/conf/httpd.conf /etc/httpd/conf/
COPY ./etc/httpd/conf.d /etc/httpd/conf.d

ENTRYPOINT [ "/entrypoint.sh" ]
