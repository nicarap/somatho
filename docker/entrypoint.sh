#!/bin/bash

# Exécuter les commandes artisan
# php artisan key:generate
# php artisan config:cache
# php artisan route:cache
# php artisan view:cache

# Lancer PHP-FPM
exec php-fpm
