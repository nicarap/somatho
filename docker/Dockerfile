FROM php:8.2-fpm as backend

# Installer des dépendances de base
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libicu-dev \
    libpq-dev \
    zlib1g-dev \
    && docker-php-ext-configure zip \
    && docker-php-ext-install intl zip pdo pdo_pgsql

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Configurer le répertoire de l'application
WORKDIR /var/www

COPY . /var/www

# Installer les dépendances Composer (ceci sera mis en cache par Docker)
RUN composer install --no-dev --optimize-autoloader

# Modifier les permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Exposer le port pour PHP
EXPOSE 8000

# Commande pour démarrer Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
