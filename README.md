# Supermetrics Social Network REST API.
> A REST API which to show stats on social network data 

## Description
This project was built with PHP and MySQL.

#### PhpDotEnv 
Handle environment variables within the application

#### SimpleRouter 
Implementation of page routing

#### Lavary/crunz
Task scheduler (cron jobs)

#### IlluminateDatabase
Toolkit for database layer
 
#### Guzzle Http
 Client that makes it easy to send HTTP requests
 
#### Phinx
Handles database migrations

## Running the Application

### Environment
Configure environment variables in `.env` for dev environment based on your MYSQL database configuration as it currently uses SQLite

```  
DB_CONNECTION=<YOUR_MYSQL_TYPE>
DB_HOST=<YOUR_MYSQL_HOST>
DB_PORT=<YOUR_MYSQL_PORT>
DB_NAME=<YOUR_DB_NAME>
DB_USER=<YOUR_DB_USERNAME>
DB_PASSWORD=<YOUR_DB_PASSWORD>
API_URL=<API_URL>
CLIENT_ID=<CLIENT_ID>
```

See [Database schema](database/database.sql)

### With Docker
To run the Application, you must install:
- **Docker** (https://www.docker.com/products/docker-desktop)

```console
$ docker build -t supermetrics-api .
```
Run Application

```console
$ docker run -p 8002:8002 supermetrics-api
```

To Run Additional commands
```console
$ docker ps
$ docker exec -it CONTAINER_ID {$command}
```

You should be able to visit your app at http://localhost:8002

### Without Docker
- **PHP** (https://www.php.net/downloads)
- **MySQL** (https://dev.mysql.com/downloads/installer)

Install Dependencies and migrate tables
```console
$ composer install
$ composer db:migrate
$ php -S localhost:8002
```

You should be able to visit your app at http://localhost:8002

# API documentation:
List of all API endpoints:

>GET /api/stats
