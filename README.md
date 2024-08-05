# Food Ordering System API

## Description

Food Ordering System API is a RESTful API endpoint to manage food delivery process from creating restaurants, menus, orders, items and lastly to make payment using payment gateway. Built using Laravel with integration of HitPay as payment gateway sandbox.

## Features

- CRUD operations for users, restaurants, menus, orders, items
- Authorization using JSON Web Token (JWT)
- Three type of roles: Administrator, Manager and Customer
- Administrator can approve restaurant registration and ban or suspend any restaurant
- Customer get to earn loyalty points with every successful transactions

## Installation

### Prerequisites

List any prerequisites or dependencies required for the project. For example:

- PHP

### Installation Steps

Step-by-step guide on how to set up the project locally:

```bash
# clone repo
git clone https://github.com/aazziibb99/food-ordering-system-api.git

# go to file directory
cd food-ordering-system-api

# install composer packages
composer update

# install node packages
npm install

# migrate sqlite database (edit .env file to set database connection)
php artisan migrate

# seed database with dummy data
php artisan db:seed

# run server
php artisan serve

# run tunnel to public internet (for HitPay webhook)
ngrok http 8000
```

### Testing API with Postman

- Download and Install Postman client
- Import Food Ordering System.postman_collection.json
- Login Details:
  + (Admin) email: "admin@example.com", password: "adminpassword"
  + (Manager) email: "siti.aishah@example.com", password: "password123"
  + (Customer) email: "ahmad.ali@example.com", password: "password123"
