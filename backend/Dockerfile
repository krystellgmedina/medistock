FROM php:8.1-apache

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    zip \
    unzip \
    git \
    gnupg2 \
    libxml2-dev \
    libpng-dev \
    zlib1g-dev \
    && rm -rf /var/lib/apt/lists/*

# Configurar e instalar extensiones PHP necesarias (intl, mbstring, pdo_pgsql, zip, xml)
RUN docker-php-ext-configure intl && \
    docker-php-ext-install -j$(nproc) intl mbstring pdo pdo_pgsql pgsql zip xml

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar Apache
COPY apache.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos del proyecto
COPY . .

# Instalar dependencias
RUN composer install --no-dev --optimize-autoloader

# Permisos para el directorio writable
RUN chmod -R 777 writable/

# Puerto expuesto
EXPOSE 80

# Comando de inicio
CMD ["apache2-foreground"]