FROM php:8.2-fpm

# Thư mục làm việc
WORKDIR /var/www

# Cài các gói cần thiết
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev

# Cài extension PHP
RUN docker-php-ext-install pdo_mysql mbstring zip exif gd

# Cài composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Sao chép mã nguồn
COPY . .

RUN mkdir -p database/factories

# Cài đặt dependency Laravel
RUN composer install --no-interaction --prefer-dist

# Phân quyền
RUN chown -R www-data:www-data /var/www

CMD ["php-fpm"]
