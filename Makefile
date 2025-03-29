start: 
	docker compose up
stop: 
	docker compose down
restart: 
	docker compose down && docker compose up
build:
	docker compose build
bash:
	docker compose exec -it admin bash