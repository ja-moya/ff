# Makefile para Laravel con Docker

# Nombre del contenedor
CONTAINER_NAME=app

# Comando para crear la imagen Docker
build:
	docker-compose build

prepare:
	docker-compose exec $(CONTAINER_NAME) composer install
	docker-compose exec $(CONTAINER_NAME) npm install
	docker-compose exec $(CONTAINER_NAME) cp /var/www/html/.env.example /var/www/html/.env
	docker-compose exec $(CONTAINER_NAME) chown -R www-data:www-data /var/www/html/storage
	docker-compose exec $(CONTAINER_NAME) chmod -R 775 /var/www/html/storage
	docker-compose exec $(CONTAINER_NAME) touch /var/www/html/database/database.sqlite
	docker-compose exec $(CONTAINER_NAME) chown -R www-data:www-data /var/www/html/database
	docker-compose exec $(CONTAINER_NAME) chmod -R 775 /var/www/html/database
	docker-compose exec $(CONTAINER_NAME) php artisan key:generate
	docker-compose exec $(CONTAINER_NAME) php artisan migrate

# Comando para arrancar el contenedor en segundo plano
up:
	docker-compose up -d

# Comando para bajar los contenedores y borrar volúmenes
down:
	docker-compose down --volumes

# Comando para acceder al contenedor de la app
exec:
	docker-compose exec $(CONTAINER_NAME) bash

# Comando para ejecutar las migraciones de la base de datos
migrate:
	docker-compose exec $(CONTAINER_NAME) php artisan migrate

# Comando para limpiar el caché de configuración de Laravel
config-clear:
	docker-compose exec $(CONTAINER_NAME) php artisan config:clear

# Comando para ver los logs del contenedor de la app
logs:
	docker-compose logs -f $(CONTAINER_NAME)

# Comando para parar los contenedores
stop:
	docker-compose stop

# Comando para construir la imagen y arrancar el contenedor
start: build up

# Comando para parar y eliminar contenedores y volúmenes
clean: down

# Comando para acceder al contenedor de la app con shell
shell:
	docker-compose exec $(CONTAINER_NAME) /bin/bash
