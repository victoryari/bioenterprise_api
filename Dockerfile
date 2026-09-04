FROM php:8.3-cli-alpine

# Instalar dependencias del sistema y extensiones de PHP necesarias
RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    postgresql-dev \
    libzip-dev \
    linux-headers \
    bash \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql sockets bcmath zip

# Instalar Composer desde la imagen oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Directorio de trabajo
WORKDIR /var/www

# Copiar archivos del proyecto
COPY . /var/www

# Instalar dependencias de PHP para producción
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Permisos para carpetas de almacenamiento y caché de Laravel
RUN chmod -R 777 /var/www/storage /var/www/bootstrap/cache

# Puerto por defecto de Render
ENV PORT=10000
EXPOSE 10000

# Comando de inicio: optimizar Laravel, correr migraciones y levantar el servidor
CMD ["sh", "-c", "php artisan config:cache && php artisan route:cache && php artisan view:cache && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-10000}"]
