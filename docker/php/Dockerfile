FROM php:8.3-fpm-alpine

ARG user
ARG uid

RUN mkdir -p /var/www/

WORKDIR /var/www/

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN addgroup -g ${uid} --system ${user}
RUN adduser -G ${user} --system -D -s /bin/sh -u ${uid} ${user} && \
    addgroup ${user} wheel && \
    mkdir -p /etc/sudoers.d && \
    echo "${user} ALL=(ALL) NOPASSWD: ALL" > /etc/sudoers.d/${user} && \
    chmod 0440 /etc/sudoers.d/${user}

RUN sed -i "s/user = www-data/user = worker/g" /usr/local/etc/php-fpm.d/www.conf && \
    sed -i "s/group = www-data/group = worker/g" /usr/local/etc/php-fpm.d/www.conf

RUN apk update && \
    apk add sudo libpq-dev freetype libpng libjpeg-turbo freetype-dev libpng-dev libjpeg-turbo-dev libwebp-dev \
        libzip-dev zip nodejs npm && \
    docker-php-ext-install pdo pdo_pgsql pgsql zip bcmath && \
    docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
        --with-webp \
    NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) && \
    docker-php-ext-install -j$(nproc) gd

RUN apk add --no-cache pcre-dev $PHPIZE_DEPS && \
    pecl update-channels && \
    pecl install redis && \
    docker-php-ext-enable redis && \
    apk del $PHPIZE_DEPS

USER ${user}
