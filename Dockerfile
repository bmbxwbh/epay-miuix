FROM php:8.1-fpm-alpine

# Install system dependencies + nginx + supervisor
RUN apk add --no-cache \
        nginx \
        supervisor \
        freetype-dev \
        libjpeg-turbo-dev \
        libpng-dev \
        libzip-dev \
        icu-dev \
        oniguruma-dev \
        linux-headers \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        gd \
        pdo \
        pdo_mysql \
        mysqli \
        mbstring \
        zip \
        intl \
        opcache \
        bcmath \
        sockets \
    && apk del freetype-dev libjpeg-turbo-dev libpng-dev libzip-dev icu-dev oniguruma-dev

# PHP config
RUN cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY docker/php.ini /usr/local/etc/php/conf.d/epay.ini

# Nginx config
COPY docker/nginx.conf /etc/nginx/http.d/default.conf
RUN mkdir -p /run/nginx

# Supervisor config
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# App source
WORKDIR /var/www/html
COPY . .

# Ensure vendor autoload exists
RUN if [ ! -f includes/vendor/autoload.php ]; then \
        cd includes && composer install --no-dev --no-interaction 2>/dev/null || true; \
    fi

# Permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chown -R www-data:www-data /var/log/nginx

EXPOSE 80
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
