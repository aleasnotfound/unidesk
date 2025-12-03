# ===== Base Image =====
FROM php:8.2-apache

# ===== Install dependencies & PHP extensions =====
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git curl \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath \
    && a2enmod rewrite

# ===== Set working directory =====
WORKDIR /var/www/html

# ===== Copy composer binary =====
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ===== Copy project files =====
COPY . .

# ===== Install Laravel dependencies =====
RUN composer install --no-dev --optimize-autoloader

# ===== Setup environment & APP_KEY =====
# Jika belum ada .env, copy dari .env.example
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# Generate APP_KEY (safe, akan replace jika belum ada)
RUN php artisan key:generate || true

# ===== Set folder permissions =====
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# ===== Expose port 80 =====
EXPOSE 80

# ===== Run Apache =====
CMD ["apache2-foreground"]
