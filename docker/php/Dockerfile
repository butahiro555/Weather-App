FROM php:8.3-fpm

# 必要なパッケージのインストールとクリーンアップ
RUN apt-get update && \
    apt-get install -y \
    git \
    vim \
    nano \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_mysql \
    # Xdebugのインストール
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && rm -rf /var/lib/apt/lists/*

# Composerのインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 作業ディレクトリの設定
WORKDIR /var/www/html

# storageディレクトリを作成して権限設定
RUN mkdir -p /var/www/html/storage && \
    chown -R www-data:www-data /var/www/html/storage

# Xdebugの設定をphp.iniに追加
COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/