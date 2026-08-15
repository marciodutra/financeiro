FROM php:8.2-apache

# Dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpq-dev \
    libzip-dev \
    libicu-dev \
    nodejs \
    npm \
    && docker-php-ext-install \
        pdo_pgsql \
        pgsql \
        bcmath \
        intl \
        zip \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Diretório da aplicação
WORKDIR /var/www/html

# Copia todo o projeto
COPY . .

# Instala dependências PHP
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader

# Instala dependências JavaScript
RUN npm install

# Compila Vite
RUN npm run build

# Permissões Laravel
RUN chown -R www-data:www-data \
    /var/www/html/storage \
    /var/www/html/bootstrap/cache

# Configuração Apache para Laravel
RUN sed -i \
    's#DocumentRoot /var/www/html#DocumentRoot /var/www/html/public#' \
    /etc/apache2/sites-available/000-default.conf

RUN printf '<Directory /var/www/html/public/>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>\n' \
    > /etc/apache2/conf-available/laravel.conf

RUN a2enconf laravel

# Porta
EXPOSE 80

# Inicialização
CMD ["apache2-foreground"]