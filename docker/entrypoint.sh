#!/bin/sh
set -e

echo "Rodando migrations..."
php artisan migrate --force

echo "Iniciando PHP-FPM..."
# Iniciar PHP-FPM em background
php-fpm -D

echo "Iniciando Nginx..."
# Iniciar Nginx em foreground
nginx -g "daemon off;"
