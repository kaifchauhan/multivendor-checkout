# Multi-Vendor Checkout System

A multi-vendor eCommerce checkout system built using Laravel.  
The system allows customers to add products from multiple vendors into a single cart and automatically splits the order per vendor during checkout.

---

## Setup Instructions

1. Clone the repository:

git clone https://github.com/kaifchauhan/multivendor-checkout.git

2. Navigate to the project directory:

cd multivendor-checkout

3. Install dependencies:

composer install

4. Create environment file:

cp .env.example .env

5. Generate application key:

php artisan key:generate

6. Configure database in `.env` file:

DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password

7. Run migrations:

php artisan migrate

8. Seed the database:

php artisan db:seed

9. Start the development server:

php artisan serve

---

## Features

- Multi-vendor product system  
- Cart with vendor-based grouping  
- Automatic order splitting per vendor  
- Stock validation during checkout  
- Basic payment flow simulation  
- Admin management for:
  - Vendors  
  - Products  
  - Orders  

---

## Architecture Overview

- Built using Laravel MVC structure  
- Controllers handle request flow  
- Business logic is separated into service classes (CheckoutService)  
- Form Requests are used for validation  
- Eloquent ORM is used for database interactions  
- Blade templates are used for UI rendering  

---

## Assumptions and Trade-offs

- Authentication is kept simple for demonstration purposes  
- No role/permission system has been implemented  
- Payment integration is not connected to any real gateway  
- UI is minimal and focused on functionality  
- No caching layer has been added  
- Designed to prioritize backend logic and system design  

---

## Tech Stack

- PHP (Laravel Framework)  
- MySQL  
- Blade Templates  
- Composer  

---

## Notes

This project focuses on backend architecture, clean separation of logic, and handling a multi-vendor checkout flow where orders are divided based on vendors automatically.
