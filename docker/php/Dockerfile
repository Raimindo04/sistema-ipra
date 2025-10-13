FROM php:8.3-fpm

# Dependências básicas
RUN apt-get update && apt-get install -y \
    git curl libpq-dev libzip-dev unzip zip \
    && docker-php-ext-install pdo pdo_pgsql zip

# Instalar extensões Redis e Opcache (melhora performance)
RUN pecl install redis && docker-php-ext-enable redis opcache

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Definir diretório de trabalho
WORKDIR /var/www

# Permissões e cache otimizado
RUN useradd -m www && chown -R www:www /var/www
USER www

# Opcional: ativa cache/opcache agressivo (dev/production)
ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS=1
ENV PHP_OPCACHE_MAX_ACCELERATED_FILES=10000
ENV PHP_OPCACHE_MEMORY_CONSUMPTION=128
ENV PHP_OPCACHE_REVALIDATE_FREQ=0
