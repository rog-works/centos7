FROM nginx:1.13-alpine

RUN apk add --update --no-cache \
      tzdata php-xdebug \
 && rm -rf /var/cache/apk/* \
 # set timezone
 && ln -sf /usr/share/zoneinfo/Asia/Tokyo /etc/localtime \
 && echo "Asia/Tokyo" > /etc/timezone

COPY ./etc/nginx/conf.d/default.conf /etc/nginx/conf.d/
