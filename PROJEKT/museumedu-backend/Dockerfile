FROM php:8.2-fpm

# Dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim unzip git curl \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip gd

# Composer telepítés
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Projekt másolása
WORKDIR /var/www
COPY . .

# Composer install
RUN composer install

# Laravel kulcs generálás
RUN php artisan key:generate

# Laravel cache clear
RUN php artisan config:cache

EXPOSE 8000
CMD php artisan serve --host=0.0.0.0 --port=8000