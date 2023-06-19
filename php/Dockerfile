FROM php:8.0-apache

# Instalar dependencias necesarias
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        zip \
        libzip-dev \
        unzip \
        python3 \
        python3-pip \
    && docker-php-ext-install \
        zip \
        mysqli \
        pdo_mysql \
    && docker-php-ext-enable mysqli pdo_mysql

# Instalar composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar PHPMailer con composer
WORKDIR /var/www/html/
RUN composer require phpmailer/phpmailer

# Actualizar e instalar paquetes
RUN apt-get update && apt-get upgrade -y
