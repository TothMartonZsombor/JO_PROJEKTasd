#!/usr/bin/env bash

# Install Composer dependencies
composer install --no-dev --optimize-autoloader

# Copy .env.example to .env if it doesn't exist
if [ ! -f ".env" ]; then
  cp .env.example .env
fi

# Generate app key
php artisan key:generate

# Run migrations (with seeding)
php artisan migrate --force --seed

# Create storage link for public access to images
php artisan storage:link
