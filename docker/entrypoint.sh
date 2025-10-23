#!/bin/sh
set -e

cd /var/www/html || exit 1

echo "Vérification des clés JWT..."
if [ ! -f config/jwt/private.pem ] || [ ! -f config/jwt/public.pem ]; then
  mkdir -p config/jwt
  openssl genpkey -algorithm RSA -out config/jwt/private.pem -pkeyopt rsa_keygen_bits:4096
  openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout
  echo "Clés JWT générées"
else
  echo "Clés JWT déjà présentes"
fi

echo "Installation des assets Symfony..."
php bin/console assets:install --no-interaction || true


echo "Vérification de la base de données..."
DB_HOST=$(php -r 'echo parse_url(getenv("DATABASE_URL"), PHP_URL_HOST);')
DB_PORT=$(php -r 'echo parse_url(getenv("DATABASE_URL"), PHP_URL_PORT) ?: "3306";')
DB_USER=$(php -r 'echo parse_url(getenv("DATABASE_URL"), PHP_URL_USER);')
DB_PASS=$(php -r 'echo parse_url(getenv("DATABASE_URL"), PHP_URL_PASS);')
DB_NAME=$(php -r 'echo trim(parse_url(getenv("DATABASE_URL"), PHP_URL_PATH), "/");')

# Attente de MySQL
for i in $(seq 1 20); do
  if nc -z "$DB_HOST" "$DB_PORT" >/dev/null 2>&1; then
    echo "Base de données accessible."
    break
  fi
  echo "En attente de MySQL..."
  sleep 2
done

# Vérifie si la base existe déjà
if mysql -h"$DB_HOST" -P"$DB_PORT" -u"$DB_USER" -p"$DB_PASS" -e "USE $DB_NAME" >/dev/null 2>&1; then
  echo "Base $DB_NAME déjà existante."
else
  echo "Création de la base $DB_NAME..."
  php bin/console doctrine:database:create --if-not-exists --no-interaction || true
fi

echo "Mise à jour du schéma Doctrine..."
php -d error_reporting=E_ERROR bin/console doctrine:schema:update --force --no-interaction || true

echo "Chargement des fixtures..."
php -d error_reporting=E_ALL\&~E_WARNING bin/console doctrine:fixtures:load --no-interaction || true

echo "Lancement de PHP-FPM..."
exec php-fpm

