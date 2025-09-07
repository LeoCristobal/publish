# Use official PHP + Apache image
FROM php:8.2-apache

# Enable required PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy project files into container
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Tell Apache to use home.php instead of index.php
RUN echo "DirectoryIndex home.php" > /etc/apache2/conf-available/directoryindex.conf \
    && a2enconf directoryindex

# Expose port 80
EXPOSE 80
