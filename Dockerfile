# Gebaseerd op het officiële PHP beeld met Apache
FROM php:8.1-apache

# Installeer vereisten voor Laravel
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_mysql

# Installeer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Stel werkdirectory in
WORKDIR /var/www/html

# Kopieer project
COPY . .

# Installeer afhankelijkheden
RUN composer install --no-dev --optimize-autoloader

# Stel permissies in
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose poort 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
