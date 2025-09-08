# Dockerfile para Symfony + PHP 8.3
FROM php:8.3-cli

# Instala extensões necessárias para Symfony e PostgreSQL
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Define diretório de trabalho
WORKDIR /app

# Copia o projeto
COPY . /app

# Porta padrão para PHP built-in server
EXPOSE 8000

# Comando padrão
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
