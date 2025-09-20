FROM php:8.1-apache

# Install PHP extensions required for MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache rewrite module (if you plan to use pretty URLs)
RUN a2enmod rewrite

# Copy project files into Apache document root
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

EXPOSE 80
