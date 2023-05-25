# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath opcache

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy project files
COPY . /var/www/html

# Install project dependencies
RUN composer install

# Generate application key
RUN php artisan key:generate

# Run database migrations
RUN php artisan migrate

# Expose port 80
EXPOSE 80

# Start Apache web server
CMD ["apache2-foreground"]