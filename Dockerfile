# Use the official PHP image as the base image
FROM php:8.2-fpm

# Set the working directory in the container
WORKDIR /var/www/html

# Copy the composer.json and composer.lock files to the container
COPY composer.json composer.lock ./

# Install PHP extensions and dependencies
RUN apt-get update \
    && apt-get install -y \
        git \
        unzip \
        libzip-dev \
    && docker-php-ext-install pdo_mysql zip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install project dependencies
RUN composer install --no-interaction --no-plugins --no-scripts

# Copy the rest of the project files to the container
COPY . .

# Set the correct permissions for Laravel storage and bootstrap/cache directories
RUN chown -R www-data:www-data storage bootstrap/cache

# Run database migrations
RUN php artisan migrate

# Expose port 8000 (or any other port your Laravel application is configured to run on)
EXPOSE 8000

# Start the Laravel application
CMD php artisan serve --host=0.0.0.0 --port=8000