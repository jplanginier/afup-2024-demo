composer:
	docker compose run app composer $(filter-out $@,$(MAKECMDGOALS))

phpunit:
	docker compose run app vendor/bin/phpunit

infection:
	docker compose run app vendor/bin/infection --threads=8