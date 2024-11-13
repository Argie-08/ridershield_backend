FROM richarvey/nginx-php-fpm:latest

COPY . .

# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV DB_CONNECTION pgsql
ENV DB_HOST dpg-csq8q2aj1k6c738eqnqg-a
ENV DB_PORT 5432
ENV DB_DATABASE ridershield
ENV DB_USERNAME ridershield_user
ENV DB_PASSWORD WcsACCedTURERs8re1j1zb1fZoEtrdJL

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]