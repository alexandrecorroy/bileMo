FROM php:7.3-fpm-buster AS builder

RUN sed -i 's|deb.debian.org|archive.debian.org|g' /etc/apt/sources.list \
 && sed -i 's|security.debian.org|archive.debian.org|g' /etc/apt/sources.list \
 && echo "Acquire::Check-Valid-Until false;" > /etc/apt/apt.conf.d/99no-check-valid \
 && apt-get update -o Acquire::Check-Valid-Until=false \
 && apt-get install -y \
    git unzip libicu-dev libzip-dev libonig-dev zip libpng-dev openssl curl zlib1g-dev netcat default-mysql-client libxml2-dev \
 && docker-php-ext-install intl opcache pdo pdo_mysql zip gd xml \
 && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html
COPY . .

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
 && php composer-setup.php --version=2.2.21 --install-dir=/usr/local/bin --filename=composer \
 && rm composer-setup.php \
 && composer --version

RUN rm -rf composer.lock vendor \
 && COMPOSER_ALLOW_SUPERUSER=1 composer remove symfony/orm-pack --no-interaction || true \
 && COMPOSER_ALLOW_SUPERUSER=1 composer require doctrine/orm:^2.7 doctrine/dbal:^2.10 doctrine/doctrine-bundle:^1.12 doctrine/doctrine-fixtures-bundle:^3.3 --no-scripts --no-interaction \
 && COMPOSER_ALLOW_SUPERUSER=1 composer install --no-interaction --no-progress --prefer-dist --no-scripts \
 && composer dump-autoload --optimize

FROM php:7.3-fpm-buster

RUN sed -i 's|deb.debian.org|archive.debian.org|g' /etc/apt/sources.list \
 && sed -i 's|security.debian.org|archive.debian.org|g' /etc/apt/sources.list \
 && echo "Acquire::Check-Valid-Until false;" > /etc/apt/apt.conf.d/99no-check-valid \
 && apt-get update -o Acquire::Check-Valid-Until=false \
 && apt-get install -y \
      openssl netcat default-mysql-client git unzip libicu-dev libzip-dev libxml2-dev zlib1g-dev libpng-dev \
 && pecl install apcu \
 && docker-php-ext-install intl opcache pdo pdo_mysql zip gd xml \
 && docker-php-ext-enable apcu \
 && rm -rf /var/lib/apt/lists/*

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
 && php composer-setup.php --version=2.2.21 --install-dir=/usr/local/bin --filename=composer \
 && rm composer-setup.php \
 && composer --version

WORKDIR /var/www/html
COPY --from=builder /var/www/html /var/www/html

RUN mkdir -p var config/jwt \
 && chown -R www-data:www-data var config/jwt vendor

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]
