# API ToDo List

API ToDo List.

## About the project

- Laravel 10.10
- Requires PHP >= 8.1
- Sqlite

## How to run the api?

**Step 1: Clone the project, run the following commands:**

**Step 2: Create file .env**
- cp .env.example .env
- Set APP_URL in .env: APP_URL=localhost:8080/api/
- Set database settings: <br>

DB_CONNECTION=sqlite <br>

**Step 3: Run docker**
- docker-composer up -d

**Step 4: Install dependences:**
- docker-compose exec app composer install

**Step 5: Create Sqlite**
- docker exec -it api-todo-app-1 /bin/bash
- touch database/database.sqlite
 <br>
To interact database with sql, run...
- sqlite3 /var/www/database/database.sqlite

**Step 6: Generate key in .env**
- docker-compose exec app php artisan key:generate

**Step 7: Install passport**
- docker-compose exec app php artisan passport:install

**Step 8: Generate tables**
- docker-compose exec app php artisan migrate

**Step 9: Generate/Update in the documentation**
- docker-compose exec app php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider
- docker-compose exec app php artisan l5-swagger:generate

** Documentation API **
- http://localhost:8000/api/documentation