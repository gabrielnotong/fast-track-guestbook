SHELL := /bin/bash

tests:
	symfony console doctrine:fixtures:load -n
	symfony php bin/phpunit
start:
	docker-compose up -d
stop:
	docker-compose stop
reset: clean stop reset-containers composer-install db launch
reset-containers:
	docker system prune -a -f
	docker volume prune -f
	docker-compose up -d
db:
	symfony console doctrine:database:drop --force
	symfony console doctrine:database:create
	symfony console doctrine:migrations:migrate -n
launch:
	php -S localhost:9080 -d error_reporting=E_ALL -t public
	symfony open:local
composer-install:
	symfony composer install
clean: del-var-vendor
cc:
	symfony console cache:clear
del-var-vendor:
	sudo rm -rf ./var ./vendor

.PHONY: tests start stop reset db launch composer-install clean del-var-vendor reset-containers
