#!/bin/sh

set -eux

wd=$(cd $(dirname $0); pwd)

if [ ! -e /usr/local/bin/composer ]; then
	curl -sS https://getcomposer.org/installer | php
	mv composer.phar /usr/local/bin/composer
	chmod +x /usr/local/bin/composer
fi

cd /var/www
composer install -vvv

echo complete!
