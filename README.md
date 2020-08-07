# Novis Hub

## Setting up (development)

``` bash
$ cp development.env.org development.env
```

Edit environment variables in `development.env`.

- `VIRTUAL_HOST`: Hostname to access from browser.
- `MYSQL_ROOT_PASSWORD`: Password which mysql container use for `root` user.

``` bash
$ cp php/development.ini.org php/development.ini
```

Create ini file for php-fpm.

``` bash
$ docker-compose -f docker-compose.development.yml run app-server /bin/sh -c 'openssl genrsa 4096 > /etc/nginx/certs/default.key'
$ docker-compose -f docker-compose.development.yml run app-server /bin/sh -c 'openssl req -new -key /etc/nginx/certs/default.key > /etc/nginx/certs/default.csr'
$ docker-compose -f docker-compose.development.yml run app-server /bin/sh -c 'openssl x509 -days 3650 -req -signkey /etc/nginx/certs/default.key < /etc/nginx/certs/default.csr > /etc/nginx/certs/default.crt'
```

Create default key and cert for app server.

``` bash
$ docker-compose -f docker-compose.development.yml run php-fpm /bin/sh -c 'composer install'
```

Install php dependencies with composer.

``` bash
$ docker-compose -f docker-compose.development.yml up
```

Build images and start containers for project.

``` bash
$ cat schema.sql | docker exec -i novis-hub-mysql-server mysql -uroot -ppassword
```

Create initial database and tables.
Make sure to replace `password` with your `MYSQL_ROOT_PASSWORD`.
