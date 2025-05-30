FROM php:8.2-cli

# Instalar extensiones necesarias para PostgreSQL
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql

# Copiar tu código a la imagen
COPY . /var/www/html

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Exponer el puerto
EXPOSE 10000

# Comando para ejecutar el servidor PHP
CMD ["php", "-S", "0.0.0.0:10000"]
