#!/bin/sh
set -e

PORT="${PORT:-8080}"
sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/:80/:${PORT}/" /etc/apache2/sites-available/000-default.conf

php artisan storage:link || true
php artisan config:cache
php artisan route:cache
php artisan view:cache

if [ "$RUN_MIGRATIONS" = "true" ]; then
  php artisan migrate --force
fi

exec apache2-foreground