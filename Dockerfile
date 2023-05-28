# Base image
FROM php:8.2-apache as laravel


# Install dependencies
RUN apt-get update \
    && apt-get install -y \
        libzip-dev \
        unzip \
        libpq-dev \
        libonig-dev \
        libxml2-dev \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        zip \
        opcache \
        mbstring \
        exif \
        pcntl \
        bcmath \
        soap \
    && a2enmod rewrite

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www

# Copy project files to container
COPY . .

COPY --from=composer:2.5.5 /usr/bin/composer usr/bin/composer

ENV PORT=8000

ENTRYPOINT [ "docker/entrypoint.sh" ]