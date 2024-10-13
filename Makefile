build:
	docker --debug compose --progress=plain build 
up:
	docker --debug compose up -d
stop:
	docker compose stop
restart: stop up
exec:
	docker compose exec apache /bin/bash
clear-cache:
	docker builder prune -a