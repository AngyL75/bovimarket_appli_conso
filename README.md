# Docker stack for Bovimarket appli conso

This stack run with docker and [docker-compose (1.7 or higher)](https://docs.docker.com/compose/).

## Installation

1. Build/run container web (with and without detached mode)

    ```bash
    $ docker-compose build
    $ docker-compose up -d
    ```

1. Prepare Symfony app :
    1. Open a bash on container with :
        ```bash
        $ docker-compose exec web bash
        ```
        __NOTE__ : Prefix this with `winpty` on Windows.
        
    1. Run `composer install` to install vendors.

1. The app is available on [localhost](http://localhost), but you can add
   a local domain `local.bovimarket-appli-conso` in your `hosts` file :
     * `/etc/hosts` on Linux hosts
     * `C:\Windows\System32\drivers\etc\hosts` on Windows hosts

1. Enjoy :-)

## Entry points & usage

Just run `docker-compose up -d`, then is directly accessible on [http://locahost](http://locahost) or [local.bovimarket-appli-conso](local.bovimarket-appli-conso)

## How it works?

Have a look at the `docker-compose.yml` file, here are the `docker-compose` built image:

* `web`: This is the main container in which the app volume is mounted.

This results in the following running containers:

```bash
$ docker-compose ps
           Name                         Command               State         Ports
----------------------------------------------------------------------------------------
bovimarket_appli_conso_web   docker-php-entrypoint apac ...   Up      0.0.0.0:80->80/tcp
```

## Useful commands

__NOTE__ : Prefix these commands ** with `winpty` on Windows.

```bash
# bash commands **
$ docker-compose exec web bash

# Composer (e.g. composer update) **
$ docker-compose exec php composer update

# Retrieve an IP Addresses
$ docker inspect -f '{{.Name}} => {{range $key, $value := .NetworkSettings.Networks}}{{.IPAddress}} on {{$key}}{{end}}' $(docker ps -q)

# Check CPU consumption
$ docker stats bovimarket_appli_conso

# Delete the container
$ docker-compose rm -s web

# Delete the image
$ docker rmi bovimarketappliconso_web
```

## FAQ

* Got this error: `ERROR: Couldn't connect to Docker daemon at http+docker://localunixsocket - is it running?
If it's at a non-standard location, specify the URL with the DOCKER_HOST environment variable.` ?  
Run `docker-compose up -d` instead.

* How to config Xdebug?
Xdebug is configured out of the box!
Just config your IDE to connect port  `9001` and id key `PHPSTORM`
