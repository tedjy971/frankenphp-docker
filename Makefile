.PHONY: help, build, up, bash, stop, down
help: ## Display this help screen
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

build: ## Build the Docker images
	docker-compose build --pull --no-cache

up: ## Start the docker hub in detached mode (no logs)
	docker-compose up -d --wait

bash: ## Connect to the FrankenPHP container via bash so up and down arrows go to previous commands
	docker-compose exec php bash

stop: ## Stop the docker hub
	docker-compose stop

down: ## Stop the docker hub
	docker-compose down --remove-orphans
