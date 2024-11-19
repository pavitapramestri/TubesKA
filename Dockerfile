FROM php:8.1-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Optional: Install pdo_mysql for PDO support
RUN docker-php-ext-install pdo_mysql && docker-php-ext-enable pdo_mysql

# Copy project files to container
COPY . /var/www/html

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port
EXPOSE 80
