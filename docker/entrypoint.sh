#!/bin/sh
set -e

echo "Rodando migrations..."
php artisan migrate --force

echo "Subindo aplicação (Modo Simples/Faculdade)..."
# Usa a porta fornecida pelo Render ou a porta 80 do Dockerfile
php artisan serve --host=0.0.0.0 --port=${PORT:-80}
