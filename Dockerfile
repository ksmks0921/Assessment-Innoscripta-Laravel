# Base image
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath opcache

# Copy project files
COPY . /var/www/html

# Install project dependencies
RUN composer install

# Generate application key
RUN php artisan key:generate

# Run database migrations
RUN php artisan migrate

# Expose port 8000
EXPOSE 8000

# Start Apache web server
CMD ["apache2-foreground"]