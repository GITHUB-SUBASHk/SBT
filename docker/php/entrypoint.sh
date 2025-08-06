#!/bin/bash
set -e

APP_DIR="/var/www/html"
DB_FILE="$APP_DIR/database/database.sqlite"

# If Laravel artisan not found, install Laravel
if [ ! -f "$APP_DIR/artisan" ]; then
  echo "Laravel not found. Installing Laravel..."
  composer create-project --prefer-dist laravel/laravel "$APP_DIR"
else
  echo "Laravel already installed. Skipping installation."
fi

# Setup .env file and generate app key if missing
if [ ! -f "$APP_DIR/.env" ]; then
  echo ".env file missing. Copying from example and generating app key..."
  cp "$APP_DIR/.env.example" "$APP_DIR/.env"
  php "$APP_DIR/artisan" key:generate
else
  echo ".env file exists. Skipping .env setup."
fi

# Ensure SQLite database file exists
if [ ! -f "$DB_FILE" ]; then
  echo "Creating SQLite database file..."
  mkdir -p "$APP_DIR/database"
  touch "$DB_FILE"
  chown www-data:www-data "$DB_FILE"
else
  echo "SQLite database file exists. Skipping creation."
fi

exec "$@"
