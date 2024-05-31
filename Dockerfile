# Gebruik het officiële PHP-beeld met Apache als basis
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
    && docker-php-ext-install pdo pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Installeer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Stel werkdirectory in
WORKDIR /var/www/html

# Kopieer projectbestanden naar de werkdirectory
COPY . .

# Installeer afhankelijkheden met Composer, optimaliseer de autoloader en genereer de applicatiesleutel
RUN composer install --no-dev --optimize-autoloader && php artisan key:generate

# Optimaliseer de configuratie en routes
RUN php artisan config:cache && php artisan route:cache

# Stel permissies in voor Laravel opslag- en cache-mappen en de public directory
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Voeg Apache-configuratie toe voor Laravel
RUN echo "\
<VirtualHost *:80>\n\
    ServerName localhost\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
    ErrorLog \${APACHE_LOG_DIR}/error.log\n\
    CustomLog \${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>\n" > /etc/apache2/sites-available/laravel.conf \
    && a2dissite 000-default.conf \
    && a2ensite laravel.conf

# Zorg dat de rewrite-module is ingeschakeld
RUN a2enmod rewrite

# Stel de ServerName in om Apache-foutmeldingen te voorkomen
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Expose poort 80
EXPOSE 80

# Start Apache in de voorgrond
CMD ["apache2-foreground"]
