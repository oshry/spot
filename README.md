# spot

Simple Laravel 5.5 Implementation

env + laravel 5.5 fresh copy
1. install env files and init(docker-compose up)
2. laravel new
3. change permissions
4. .env.example => .env + php artisan key:generate

db
1. config .env db params
2. create 'spot' db
3. php artisan migrate:install
4. php artisan migrate
note: added exported db at the root/spot.sql

console command
1. php artisan make:command Simulate
