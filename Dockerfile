# Use the official FrankenPHP image with PHP 8.3
FROM dunglas/frankenphp:8.4

# Install system dependencies, including Node.js
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libsqlite3-dev \
    supervisor \
    sqlite3

# Install PHP extensions
RUN install-php-extensions \
    pdo_sqlite \
    opcache \
    bcmath \
    intl \
    zip \
    gd \
    imagick

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
# Set working directory
WORKDIR /var/www/html
COPY . .

RUN composer install --no-interaction --prefer-dist --optimize-autoloader


# Copy the custom entrypoint script and make it executable
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80

# Set the entrypoint for the container
ENTRYPOINT ["entrypoint.sh"]

# FrankenPHP is started directly in the entrypoint script
