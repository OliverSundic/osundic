@echo off
echo Starting Laravel setup...

:: Install PHP dependencies
composer install

:: Copy .env if not exists
if not exist .env (
    copy .env.example .env
)

:: Generate application key
php artisan key:generate

:: Run database migrations
php artisan migrate

:: Install frontend dependencies
npm install

:: Start frontend build (non-blocking)
start cmd /k "npm run dev"

:: Start Laravel backend server (non-blocking)
start cmd /k "php artisan serve"

echo Laravel development environment started.
pause
