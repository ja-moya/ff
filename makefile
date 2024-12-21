# Makefile para Laravel con Docker

# Nombre del contenedor
CONTAINER_NAME=app

# Comando para crear la imagen Docker
build:
	docker-compose build

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
