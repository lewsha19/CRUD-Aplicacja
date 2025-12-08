FROM php:8.2-cli-alpine

# Встановлення системних залежностей та PHP розширень
RUN apk add --no-cache \
    git \
    sqlite \
    sqlite-dev \
    unzip \
 && docker-php-ext-configure pdo_sqlite \
 && docker-php-ext-install pdo_sqlite

# Встановлення Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Робоча директорія
WORKDIR /var/www

# Копіювання файлів проекту
COPY . /var/www

# Встановлення залежностей та створення директорій
RUN composer install --no-dev --optimize-autoloader \
 && mkdir -p app/log \
 && chmod -R 777 app/log

# Порт
EXPOSE 8080

# Скрипт запуску
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]

