# Usamos Composer para instalar dependencias
FROM composer:2.1.12 as build

WORKDIR /app
COPY . /app

# Instalamos dependencias con Composer
RUN composer install --ignore-platform-reqs --no-interaction --no-plugins --no-scripts

# Usamos una imagen PHP con Apache para producción
FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql

# Copiamos los archivos de la etapa de construcción
COPY --from=build /app /var/www/

# Configuramos Apache
COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY .env.example /var/www/.env

RUN chmod 777 -R /var/www/storage/ && \
    echo "Listen 8080" >> /etc/apache2/ports.conf && \
    chown -R www-data:www-data /var/www/ && \
    a2enmod rewrite

EXPOSE 8080
