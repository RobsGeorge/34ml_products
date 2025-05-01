# Introduction
This is a repository created to serve as a functioning API named /products for an ecommerce system

## How to Run this Project?
### 1. Clone the Repository
`git clone https://github.com/RobsGeorge/34ml_products.git`
`cd 34ml_products`

### 2. Install PHP Dependencies via Composer
`composer install`

### 3. the `.env` file is found in the repo, so as to run the project directly.

### 4. Now, make sure that you are having a phpMyAdmin server running. Then, Create a new database named "products_task"

### 5. Generate Application Key
`php artisan key:generate`

### 6. Run Migrations
`php artisan migrate`

### 7. Run Seeders
`php artisan db:seed`

### 8. Run the Local Development Server
`php artisan serve`

### 9. Visit http://localhost:8000/api/products to access the API
