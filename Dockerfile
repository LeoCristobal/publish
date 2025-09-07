# Use official PHP + Apache image
FROM php:8.2-apache

# Install Postgres + MySQL extensions
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql mysqli pdo_mysql

# Copy project files into container
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Default page (home.php)
RUN echo "DirectoryIndex index.php" > /etc/apache2/conf-available/directoryindex.conf \
    && a2enconf directoryindex

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
