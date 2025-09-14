# Start with official WordPress image
FROM wordpress:6.4-php8.2-apache

# Install additional PHP extensions
RUN docker-php-ext-install opcache

# Copy our custom wp-content over the default
COPY wp-content/ /var/www/html/wp-content/

# Copy Railway wp-config (wp-content repo structure)
COPY wp-config-railway.php /var/www/html/wp-config.php

# Copy health check file
COPY health.php /var/www/html/health.php

# Create uploads directory and set permissions
RUN mkdir -p /var/www/html/wp-content/uploads
RUN chown -R www-data:www-data /var/www/html/wp-content
RUN find /var/www/html/wp-content -type d -exec chmod 755 {} \;
RUN find /var/www/html/wp-content -type f -exec chmod 644 {} \;

# Enable mod_rewrite for pretty URLs
RUN a2enmod rewrite

# Custom Apache configuration for WordPress
RUN echo '<Directory /var/www/html/>\n\
    Options -Indexes\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>\n\
\n\
# Security headers\n\
Header always set X-Content-Type-Options nosniff\n\
Header always set X-Frame-Options DENY\n\
Header always set X-XSS-Protection "1; mode=block"' > /etc/apache2/conf-available/wordpress-security.conf

RUN a2enconf wordpress-security
RUN a2enmod headers

# Set proper WordPress file permissions
RUN chown -R www-data:www-data /var/www/html
RUN find /var/www/html -type d -exec chmod 755 {} \;
RUN find /var/www/html -type f -exec chmod 644 {} \;

# Health check file already copied above

EXPOSE 80

# Use standard WordPress startup
CMD ["apache2-foreground"]