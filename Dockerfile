# Gunakan PHP + Apache
FROM php:8.2-apache

# Install dependency
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git curl \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath \
    && a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy source code
COPY . .

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install dependencies Laravel
RUN composer install --no-dev --optimize-autoloader

# Set permissions storage & cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
