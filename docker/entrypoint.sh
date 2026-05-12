#!/bin/sh
set -e

echo "Rodando migrations..."
php artisan migrate --force

echo "Subindo php-fpm em background..."
php-fpm -D

echo "Subindo nginx..."
nginx -g "daemon off;"
