# Usa imagem oficial do PHP com Apache
FROM php:7.4-apache

# Atualiza pacotes e instala dependências do PostgreSQL e ferramentas necessárias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    gcc \
    make \
    autoconf \
 && docker-php-ext-install pdo pdo_pgsql \
 && apt-get clean \
 && rm -rf /var/lib/apt/lists/*

# Copia os arquivos do projeto
COPY . /var/www/html

# Define o diretório de trabalho
WORKDIR /var/www/html

# Dá permissão de escrita
RUN chown -R www-data:www-data /var/www/html

# Habilita mod_rewrite
RUN a2enmod rewrite

# Expõe a porta 80
EXPOSE 80
