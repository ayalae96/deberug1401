FROM php:8.2-apache

# 1. Instalar y habilitar la extensión mysqli para MySQL
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# 2. Habilitar mod_rewrite para que las rutas de tu MVC funcionen
RUN a2enmod rewrite

# 3. Copiar los archivos de tu proyecto al servidor
COPY . /var/www/html/

# 4. Configurar Apache para que apunte a la carpeta /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 5. Asegurar permisos para que el servidor pueda leer los archivos
RUN chown -R www-data:www-data /var/www/html