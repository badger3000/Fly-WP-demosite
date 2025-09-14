# Minimal WordPress setup
FROM wordpress:6.4-php8.2-apache

# Copy wp-config for Railway
COPY wp-config-railway.php /var/www/html/wp-config.php

# Copy health check
COPY health.php /var/www/html/health.php

# Copy themes (skip if causing issues)
COPY wp-content/ /var/www/html/wp-content/

# Basic permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80