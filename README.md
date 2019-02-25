
# Photinator

Photinator is a simple Laravel Full-stack applicaion to display photos for a registered user to like/unlike. Guest users can see the ranking of the top users in Photinator and the most recently liked photos.

## Installation

Required: [Laravel](https://laravel.com/) and a MySQL Database. After pulling the Git repository, perform the following steps after navigating to your local directory:

```bash
npm install
```
Installs NPM Packages
```bash
npm update
```
Updates NPM Packages
> Before the next step, please configure the .env file correctly with your MySQL settings


```bash
php artisan migrate
```
Migrates MySQL Database
```bash
npm run production
```
Runs the VueTemplate Compiler
```bash
php artisan serve
```
Navigate to [http://127.0.0.1:8000](http://127.0.0.1:8000) to access the running app.

Note: The [JSONPlaceholder API](http://jsonplaceholder.typicode.com/) is used to show sample images. You may chose to use any other REST API for images. 
