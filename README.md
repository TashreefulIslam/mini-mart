# Mini-Mart

Mini-Mart is a Laravel-based mini e-commerce application designed to showcase a complete shopping experience in a simple, beginner-friendly way. The project includes product browsing, category-based organization, a shopping cart, checkout, order management, authentication, and an admin dashboard.

It is built as a practical learning project for Laravel full-stack development, with a clean UI and a structure that is easy to understand and extend.

## Features

- Responsive storefront for browsing products
- Product listing and product detail pages
- Category-based product organization
- Shopping cart with add, update, and remove actions
- Checkout and order placement flow
- Customer account area with order history
- Admin dashboard for managing categories, products, users, and orders
- Role-based access for admins and customers
- Simple, clean Blade-based UI with Laravel routing and controllers

## Tech Stack

- Laravel
- PHP
- MySQL
- Blade Templates
- Tailwind CSS
- Vite
- Pest / PHPUnit for testing

## Project Goals

Mini-Mart was created to demonstrate core e-commerce workflows in Laravel without overcomplicating the project. The focus is on clear MVC structure, Eloquent relationships, form validation, authentication, and a functional user experience.

## Installation

1. Clone the repository
   ```bash
   git clone <your-repo-url>
   cd mini-mart
   ```

2. Install PHP dependencies
   ```bash
   composer install
   ```

3. Install frontend dependencies
   ```bash
   npm install
   ```

4. Create your environment file
   ```bash
   cp .env.example .env
   ```

5. Configure your database in the `.env` file
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=mini_mart
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. Generate the application key
   ```bash
   php artisan key:generate
   ```

7. Run migrations and seed the database
   ```bash
   php artisan migrate --seed
   ```

8. Start the development server
   ```bash
   php artisan serve
   ```

9. Open the app in your browser
   ```text
   http://127.0.0.1:8000
   ```

## Default Admin Credentials

A seeded admin account is available:

- Email: `admin@minimart.com`
- Password: `admin123`

You can access the admin dashboard at:

```text
http://127.0.0.1:8000/admin/dashboard
```

## Project Structure

```text
app/                 # Controllers, models, middleware
database/            # Migrations and seeders
resources/views/     # Blade templates
routes/              # Application routes
public/              # Public assets
```

## Usage Summary

- Visitors can browse products and view details.
- Customers can register, log in, manage a cart, and place orders.
- Admins can manage products, categories, users, and orders from the dashboard.

## License

This project is open-source and available under the MIT License.

