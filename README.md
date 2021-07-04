# Snappfood 

## Installation

- cp .env.example .env
- docker-compose up -d
- docker-compose exec php php artisan key:generate
- docker-compose exec php composer install
- docker-compose exec php php artisan migrate

## Testing

You can run tests with this command:

- docker-compose exec php php artisan test


## How to use

There are 2 endpoints in this project:

1. GET  /menu

This endpoint returns a list of foods that user can order.

2. POST  /order

Params:
 - food_id

With this endpoint a user can order the food

