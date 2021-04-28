# PHP + Apache
FROM php:7.4-apache

# Install PHP extensions needed
RUN apt-get update && apt-get install -y \
        git \
        curl \
    && docker-php-source delete

RUN docker-php-ext-install pdo pdo_mysql

# Enable common Apache modules
RUN a2enmod headers expires rewrite

# Set working directory to workspace
WORKDIR /var/www/html
COPY . /var/www/html

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader


CMD ["php", "-S", "0.0.0.0:8002", "./index.php"]
EXPOSE 8002
