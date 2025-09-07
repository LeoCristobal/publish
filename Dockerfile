# Use official PHP + Apache image
FROM php:8.2-apache

# Install PostgreSQL libraries and PHP extensions
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql pgsql

# Copy project files into container
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Tell Apache to use home.php instead of index.php
RUN echo "DirectoryIndex home.php" > /etc/apache2/conf-available/directoryindex.conf \
    && a2enconf directoryindex

# Expose port 80
EXPOSE 80
