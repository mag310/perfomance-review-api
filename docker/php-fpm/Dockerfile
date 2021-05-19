FROM php:7.4-fpm

ENV DEBIAN_FRONTEND noninteractive
RUN apt-get update
RUN apt-get install -y \
        curl \
        wget \
        git \
        unzip \
		libmcrypt-dev \
        libsodium-dev \
        libpng-dev \
        libonig-dev \
    && docker-php-ext-install -j$(nproc) iconv sodium mbstring opcache

RUN apt-get install -y \
		libssl-dev \
		pkg-config \
	&& pecl install mongodb \
	&& docker-php-ext-enable mongodb

ENV DEBIAN_FRONTEND teletype

# composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /var/www
CMD ["php-fpm"]
