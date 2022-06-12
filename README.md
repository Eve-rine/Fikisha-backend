# Fikisha LTD Backend 

## Project setup

## Installation
```
Clone the repository 
Create an '.env' file in the project root folder and copy contents of '.env.example' into it
Inside the project folder run 'composer install' to install packages

```
### Database Set up
```
Create a mysql database called 'fikisha'
Run database migrations with the command 'php artisan:migrate'
Create a user
```
### Run the application
```
On the project directory run 'php artisan serve'

```
### Seeding the database to add orders using laravel faker
#### This should be done after creating some customers because the orders are dependent on customers
Run the command 'php artisan db:seed'


