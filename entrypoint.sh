#!/bin/bash
set -e

# Colors for output
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Function to print colored output
print_message() {
    echo -e "${GREEN}[Laravel Entrypoint]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[Laravel Entrypoint]${NC} $1"
}

# Navigate to the Laravel directory
cd /var/www/html

# 1. Check if .env exists
if [ ! -f .env ]; then
    print_message ".env file not found, copying from .env.example..."
    cp .env.deploy .env
else
    print_message ".env file already exists."
fi

# 2. Check if APP_KEY is set
if ! grep -q '^APP_KEY=base64:' .env; then
    print_message "APP_KEY not found, generating..."
    php artisan key:generate
else
    print_message "APP_KEY already set."
fi

echo "APP_URL=$APP_URL" >> .env
echo "TMDB_KEY=$TMDB_KEY" >> .env
echo "TMDB_LANG=$TMDB_LANG" >> .env
echo "APP_LOCALE=$APP_LOCALE" >> .env


# 3. Check if database exists (for SQLite)
# Source the .env file to get variables
source .env
if [ "$DB_CONNECTION" = "sqlite" ] && [ ! -f "$DB_DATABASE" ]; then
    print_message "SQLite database not found, creating it at $DB_DATABASE..."
    # Ensure directory exists
    mkdir -p "$(dirname "$DB_DATABASE")"
    touch "$DB_DATABASE"
else
    print_message "SQLite database already exists or not using SQLite."
fi


# 5. Run database migrations
print_message "Running database migrations..."
php artisan migrate --force


# 7. Cache Laravel configs for performance
print_message "Caching Laravel configurations..."
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link

# 8. Set correct permissions
print_message "Setting correct permissions for storage and cache directories..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

print_message "✅ Setup complete! Starting FrankenPHP..."

# Start FrankenPHP directly
exec frankenphp php-server --listen 0.0.0.0:80 --root /var/www/html/public
