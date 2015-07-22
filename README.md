# Game-BootCamp

## Requires
* PHP version: 5.5
* MySQL version: 5.1

## Setting up project
You have to create database, then you have to change DB information in fuel/app/config/development/db.php.

```sh
$ git clone --recursive [repository url]
$ cd game-bootcamp
$ composer install
$ php oil r install
$ vi fuel/app/config/development/db.php
$ php oil r migrate --packages=auth
$ php oil r migrate
```
