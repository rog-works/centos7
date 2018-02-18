#!/bin/sh

set -eux

if [ -e .pre_init ]; then
	echo 'init finished'
	exit;
fi

# get working directory
wd=$(cd $(dirname $0); pwd)

# define domains
domains='app'

# install composer
if [ ! -e /usr/local/bin/composer ]; then
	curl -sS https://getcomposer.org/installer | php
	mv composer.phar /usr/local/bin/composer
	chmod +x /usr/local/bin/composer
fi

# install dependencies
for domain in `echo $domains`; do
	cd /var/www/$domain
	cp $wd/app/composer.* ./
	composer install
done

# initialize complete
touch $wd/.pre_init
echo complete!
