FROM php:8.2-apache

# Install MySQL-related PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache modules if needed (e.g., mod_rewrite)
# Not strictly necessary for this setup unless you're using .htaccess
RUN a2enmod rewrite

# Copy the entire project into the Apache web root
COPY . /var/www/html/

# Set proper permissions (optional)
RUN chown -R www-data:www-data /var/www/html
