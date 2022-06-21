# Lineage Shop Application | API

This is an API of Lineage Shop application.

## Pre-requisites

- PHP 7.4

- MySQL 5.7

## Usage

The following sections describe dockerized environment.

Just keep versions of installed software to be consistent with the team and production environment (see [Pre-requisites](#pre-requisites) section).

```bash
cp .env.example .env
docker-compose up -d
docker-compose exec app composer install   
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan jwt:secret
docker-compose exec app php artisan migrate:fresh --seed
```

For work Laravel 

If you need laravel queue, you must run this command:
```bash
docker-compose exec app php artisan queue:work beanstalkd
```


For ease of development, you can run the data generation function for the Laravel IDE Helper.
```bash
php artisan ide-helper:generate
php artisan ide-helper:models -N
php artisan ide-helper:meta
```


API is available on [http://localhost:8000](http://localhost:8000).

In case you use your own environment, make sure you configured services correctly in the `.env` file.

## Debugging

To debug the application we highly recommend you to use xDebug, it is already pre-installed in dockerized environment, but you should setup your IDE.

## Helpful information

- `php artisan log:clear ` - use this command to clean log file


## Useful links

- [Laravel docs](https://laravel.com/docs/7.x/installation)
