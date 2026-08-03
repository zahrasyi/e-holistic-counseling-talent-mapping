FROM --platform=linux/amd64 php:8.3-apache-trixie

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpng-dev \
    zlib1g-dev \
    libwebp-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libmagickwand-dev \
    pkg-config \
    git \
    unzip \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Configure git
RUN git config --global --add safe.directory /var/www/html

# Install Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

# Install Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Configure and install GD extension
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp

# Install core PHP extensions
RUN docker-php-ext-install \
    mysqli \
    gettext \
    gd \
    zip \
    pdo \
    pdo_mysql \
    opcache \
    mbstring \
    xml \
    ctype \
    bcmath

# install imagick
RUN apt-get update && apt-get install -y libmagickwand-dev --no-install-recommends && rm -rf /var/lib/apt/lists/*

RUN mkdir -p /usr/src/php/ext/imagick; \
  curl -fsSL https://github.com/Imagick/imagick/archive/refs/tags/3.8.0.tar.gz | tar xvz -C "/usr/src/php/ext/imagick" --strip 1; \
  docker-php-ext-install imagick;

# Set working directory
WORKDIR /var/www/html

# Copy application code
COPY . .

# Install PHP dependencies
RUN COMPOSER_PROCESS_TIMEOUT=600 composer install --no-scripts --prefer-dist --no-dev --no-interaction --no-progress --no-suggest --optimize-autoloader

# Set up Apache
RUN a2enmod rewrite

# Copy Apache configuration
COPY ./docker/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY ./docker/mpm_event.conf /etc/apache2/mods-available/mpm_event.conf
COPY ./docker/php.ini /usr/local/etc/php/conf.d/php.ini

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Create storage directories if they don't exist
RUN mkdir -p /var/www/html/storage/app/public \
    && mkdir -p /var/www/html/storage/framework/cache \
    && mkdir -p /var/www/html/storage/framework/sessions \
    && mkdir -p /var/www/html/storage/framework/views \
    && mkdir -p /var/www/html/storage/logs \
    && mkdir -p /var/www/html/bootstrap/cache
    
# Expose port 80
EXPOSE 80

# Start Apache
ENTRYPOINT ["apache2-foreground"]
