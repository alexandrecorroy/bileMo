# Bilemo

It's a Symfony 4 project. An api REST which centralizes the information of telephone operators and their customers.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

What things you need to install the software and how to install them

```
PHP 7.2
MySQL 5.7
APCU
```

### Installing

First :

```
Git clone https://github.com/alexandrecorroy/bileMo.git
```

Update ".env.dist" with your parameters and rename it into ".env"

```
# This file is a "template" of which env vars need to be defined for your application
# Copy this file to .env file for development, create environment variables when deploying to production
# https://symfony.com/doc/current/best_practices/configuration.html#infrastructure-related-configuration

###> symfony/framework-bundle ###
APP_ENV=prod
APP_SECRET=
#TRUSTED_PROXIES=127.0.0.1,127.0.0.2
#TRUSTED_HOSTS=localhost,example.com
###< symfony/framework-bundle ###

###> doctrine/doctrine-bundle ###
# Format described at http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html#connecting-using-a-url
# For an SQLite database, use: "sqlite:///%kernel.project_dir%/var/data.db"
# Configure your db driver and server_version in config/packages/doctrine.yaml
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
###< doctrine/doctrine-bundle ###

###> lexik/jwt-authentication-bundle ###
JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem
JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem
JWT_PASSPHRASE='your_secret_passphrase'
###< lexik/jwt-authentication-bundle ###

###> Blackfire config ###
BF_CLIENT_ID=
BF_CLIENT_TOKEN=
###< Blackfire config ###

```

Install Dependencies :

```
composer install
```

Install DB :

```
php bin/console d:d:c
php bin/console doctrine:schema:update --force
```

Install JWT private and public keys :

```
$ mkdir -p config/jwt
$ openssl genrsa -out config/jwt/private.pem -aes256 4096
$ openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem

In case first openssl command forces you to input password use following to get the private key decrypted

$ openssl rsa -in config/jwt/private.pem -out config/jwt/private2.pem
$ mv config/jwt/private.pem config/jwt/private.pem-back
$ mv config/jwt/private2.pem config/jwt/private.pem
```

Install fixtures :

```
php bin/console doctrine:fixtures:load
```

To test customerUser features, go to ^/api/login_check in POST Method with body : 

```
{
	"username": "sfr",
	"password": "sfr"
}
```

To test admin features, go to ^/api/login_check in POST Method with body : 

```
{
	"username": "admin",
	"password": "admin"
}
```

## Tests

Testing the application with PHPUnit :
```
./bin/phpunit
```

[Code Coverage](https://103-139430356-gh.circle-artifacts.com/0/coverage-result/index.html)

## Docs

You can view documentation on swagger  :

[Swagger UI](https://app.swaggerhub.com/apis-docs/corroyalexandre/Bilemo/1.0.0)

or in local :

^/api/doc

## Authors

* **Corroy Alexandre** - *Initial work* - [CORROYAlexandre](https://github.com/alexandrecorroy)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## SensioLabs Insight

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/a335a0a7-d213-4b27-bd40-e2c9feec75af/big.png)](https://insight.sensiolabs.com/projects/a335a0a7-d213-4b27-bd40-e2c9feec75af)

