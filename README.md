# Symfony insigth
[![SymfonyInsight](https://insight.symfony.com/projects/c7c5cb69-7966-4c74-a51e-91679d082623/big.svg)](https://insight.symfony.com/projects/c7c5cb69-7966-4c74-a51e-91679d082623)


# TODO&CO

A todo list application improved from Symfony 3.4 to 5.3.12.

## Environment and technologies
* Symfony 5.3.12
* Composer 2.1.12
* PHP 8.0.13
* MySQL 8.0.21

## Installation
Execute the following command to clone the project:
```
git clone https://github.com/alkomaJunior/ToDo-and-Co.git
```
Use the following command to install dependencies:
```
composer install
```
## Database
Set up your database url in .env file:
```
DATABASE_URL=mysql://database_user:database_password@127.0.0.1:3306/database_name?version=your_database_version
```
Create the database with the following command:
```
php bin/console doctrine:database:create
```
Create the schema with the following command:
```
php bin/console doctrine:schema:create
```
Generate migrations with the following command:
```
php bin/console make:migration
```

Apply migrations with the following command:
```
php bin/console doctrine:migrations:migrate
```
## Run the application
run the server with:
```
php bin/console server:run
```
## Documentation API - Swagger
```
https://localhost:8000 (local server)
https://github.com/alkomaJunior/ToDo-and-Co
```
