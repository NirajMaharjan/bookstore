FROM php:8.1-apache

RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN a2enmod rewrite

# Copy files into bookstore folder
COPY . /var/www/html/bookstore/

# Change Apache's DocumentRoot to /var/www/html/bookstore
RUN sed -i 's|/var/www/html|/var/www/html/bookstore|g' /etc/apache2/sites-available/000-default.conf
RUN sed -i 's|/var/www/html|/var/www/html/bookstore|g' /etc/apache2/apache2.conf

WORKDIR /var/www/html/bookstore

EXPOSE 80
