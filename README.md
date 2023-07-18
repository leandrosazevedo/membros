# SLIM 4 - API MEMBROS

RESTful API development, usando [Slim PHP micro framework](https://www.slimframework.com).

Tecnologias usadas: `PHP 8, Slim 4, MySQL, PHPUnit, dotenv, Docker & Docker Compose`.

[![Software License][ico-license]](LICENSE.md)

[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat


## :gear: QUICK INSTALL:

### Requirements:

- Composer.
- PHP >= 8.1
- MySQL/MariaDB.
- or Docker.


### With Composer:

You can create a new project running the following commands:

```bash
composer install
composer test
composer start
```


#### Configure your connection to MySQL Server:

By default, the API use a MySQL Database.

You should check and edit this configuration in your `.env` file:

```
DB_HOST='127.0.0.1'
DB_NAME='yourMySqlDatabase'
DB_USER='yourMySqlUsername'
DB_PASS='yourMySqlPassword'
DB_PORT='3306'
```


### With Docker:

If you like Docker, you can use this project with **docker** and **docker-compose**.


**Minimal Docker Version:**

* Engine: 18.03+
* Compose: 1.21+


**Docker Commands:**

```bash
# Create and start containers for the API.
docker-compose up -d --build

# Checkout the API.
curl http://localhost:8082

# Stop and remove containers.
docker-compose down
```

## :bookmark: ENDPOINTS:

### BY DEFAULT:

- Olá mundo: `GET /`

- Teste: `GET /status`