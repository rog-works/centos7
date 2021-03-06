Phalcon workspace
===

# Requirements

* VirtuaBox: 5.2.6
* Vagrant: 2.0.1
* Docker: 17.12.0-ce
* docker-compose: 1.18.0

# Dependencies

* Nginx: 1.13
* PHP: 7.2.5
* Phalcon: 3.3.2

# Usage

```bash
[host]$ cd /path/to/workspace

# install vagrant plugin
[host]$ vagrant plugin install vagrant-vbguest

# running virtual machine
[host]$ vagrant up
[host]$ vagrant ssh

# running docker containers
[vagrant]$ cd /vagrant
[vagrant]$ docker-compose build
[vagrant]$ docker-compose up -d

# initializing application
[vagrant]$ docker-compose app ash -c 'cd /root/scripts; sh pre_init.sh'

# initializing database
[vagrant]$ docker-compose db bash -c 'mysql -u root < /root/init.sql'

# checking application
[vagrant]$ exit
[host]$ curl localhost
```

## CLI

```bash
# login app
[vagrant] cd /vagrant
[vagrant] docker-compose exec app ash

# executed cli task
[app]$ env APP_ENV=local php bootstrap-cli.php <task> <action> [arguments...]
```
