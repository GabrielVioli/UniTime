#!/bin/sh

# Rodar migrações se necessário (cuidado em produção)
# php artisan migrate --force

# Iniciar PHP-FPM em background
php-fpm -D

# Iniciar Nginx em foreground
nginx -g "daemon off;"
