#!/bin/bash
set -e

php artisan migrate --seed --force
php artisan storage:link 2>/dev/null || true

php-fpm -D
exec nginx -g 'daemon off;'
