@echo off
cd C:\xampp\htdocs\project-management
php artisan schedule:run >> scheduler.log
