FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip curl sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Create SQLite database
RUN mkdir -p database
RUN touch database/database.sqlite

# Set permissions
RUN chmod -R 777 storage bootstrap/cache database

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000
