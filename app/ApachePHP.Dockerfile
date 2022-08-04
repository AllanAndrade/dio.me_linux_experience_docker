FROM php:8.1.8-apache-bullseye

RUN \
    # Define o PHP.INI a ser utilizado (em produção usar o .ini de produção)
    mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini" \
    # Ativa o BROTLI em substituição ao GZIP
    ; a2enmod brotli \
    # Ativa o módulo REWRITE do apache
    ; a2enmod rewrite \
    #
    ###############################################################################
    # HABILITANDO O CACHE
    ###############################################################################
    # Cria pasta para cache
    ; mkdir /apache2cache \
    ; chown www-data:www-data /apache2cache/ -R \
    ; a2enmod cache \
    ; a2enmod cache_disk \
    ; a2enmod expires \
    ###############################################################################
    ###############################################################################
    #
    # Instala, e já habilita por padrão, o driver específico para PDO com MySQL
    ; docker-php-ext-install pdo_mysql \
    # Instala lib GD
    ; apt-get update  \
    ; apt-get install --no-install-recommends -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev libwebp-dev syslog-ng \
        iputils-ping \
    ; docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    ; docker-php-ext-install gd \
    # Permissão da pasta /var/www
    ; chown www-data:www-data /var/www -R \
    #exclui arquivos temporários 
    ; apt autoremove ; apt autoclean ; apt clean \
    ; rm -rf /tmp/pear/ 