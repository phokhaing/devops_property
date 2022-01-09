FROM php:7.4-apache
COPY . /var/www/html/
# COPY site/htaccess /var/www/html/site/.htaccess
# RUN ["cp",  "/var/www/html/site/htaccess", "/var/www/html/site/.htaccess"]
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql
RUN a2enmod rewrite
RUN service apache2 restart
# RUN chown -R 777 www-data:www-data /var/www/html/

# allow readable, writable and executable by all users
RUN chmod 777 /var/www/html/ 
EXPOSE 80
# CMD ["apache2-foreground"]
# - chmod -R 755 wp-content
# - chown -R apache:apache wp-content
# - service httpd start
# - chkconfig httpd on