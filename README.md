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


# Main Project Components
## Database Structure

### 1. Products Table: 
Stores the main product information including title, stock status, and average rating.
### 2. Variants Table: 
Contains product variants with options, price, and stock information.

### 3. Options Table: 
Holds option names (like "Color", "Size") and their possible values.
### 4. Option-Product Pivot Table: 
Manages the many-to-many relationship between products and options.

## Models Structure

### 1. Products Model: 
- Contains relationships to variants and options
- Has methods to update stock status and set the default variant (lowest price)
- Triggers the ProductOutOfStock event when needed
### 2. Variants Model: 
- Has observers to automatically update stock status when saved
- Updates the parent product's stock status when needed
### 3. Option Model

## API Implementation
The **`/api/products`** endpoint supports all the requested filters:
- `?filter[average_rating]=3` - Shows products with specified minimum rating
- `?filter[options]=red,small` - Filters by option values
- `?filter[max_price]=20.0` - Shows products with variants under the specified price

## Out-of-Stock Notification System
When a product goes out of stock:
- The `ProductOutOfStock` event is fired
- The event listener `SendProductOutOfStockNotification` handles the event
- A notification is sent to admin@34ml.com with details about the out-of-stock product'

## Default Variant Logic
The product's default variant is set to the one with the lowest price using the `setDefaultVariant()` method.

# THANK YOU!
