FROM php:7.4-fpm

# Arguments defined in docker-compose.yml
ARG user=appuser
ARG uid=1000

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user && \
    mkdir /var/lib/app && \
    mkdir /var/lib/app/in && \
    mkdir /var/lib/app/out && \
    chown -R $user:$user /var/lib/app && \
    chown -R $user:$user /var/lib/app/in && \
    chown -R $user:$user /var/lib/app/out

# Set working directory
WORKDIR /var/www

USER $user
