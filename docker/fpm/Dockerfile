FROM php:8.3.2-fpm

RUN apt-get update -y && apt-get install -y \
        libonig-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libldap2-dev  \
        libcurl3-dev \
        libpng-dev \
        libpq-dev \
        supervisor \
        unzip \
        git \
        libzip-dev \
        zip \
        nano \
        cron \
        rsyslog \
    && git config --global http.sslVerify false \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
    && docker-php-ext-install -j$(nproc) ldap iconv opcache mbstring mysqli pdo pdo_mysql zip gd bcmath pcntl curl exif

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


WORKDIR /var/www/laravel
