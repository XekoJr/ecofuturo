FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql mysqli \
    && a2enmod rewrite

WORKDIR /var/www/html

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html/assets/images/uploads \
    && chmod -R 775 /var/www/html/assets/images/uploads

EXPOSE 80
