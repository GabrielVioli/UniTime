FROM node:20-alpine as node-stage
WORKDIR /app
COPY . .
RUN npm install && npm run build

FROM php:8.3-cli-alpine

RUN apk add --no-cache icu-dev libpq-dev libzip-dev zip unzip git \
    && docker-php-ext-install pdo pdo_pgsql intl zip bcmath

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .
COPY --from=node-stage /app/public/build ./public/build

RUN composer install --no-dev --optimize-autoloader --no-interaction \
    && chown -R www-data:www-data storage bootstrap/cache

EXPOSE 8000
