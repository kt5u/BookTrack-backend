# BookTrack Backend Setup Guide

This guide will help you set up the BookTrack backend and create database migrations based on your dbdiagram.io diagram.

## Prerequisites

- PHP >= 8.2
- Composer
- MySQL/MariaDB or PostgreSQL database server
- Git

## Step 1: Install Dependencies

```bash
composer install
```

This will install Laravel and all required dependencies defined in `composer.json`.

## Step 2: Environment Configuration

1. Copy the example environment file:
```bash
cp .env.example .env
```

2. Generate an application key:
```bash
php artisan key:generate
```

3. Configure your database connection in `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=booktrack
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

## Step 3: Add Your Database Diagram

1. Export your database diagram from dbdiagram.io:
   - Go to your dbdiagram.io project
   - Click on "Export" 
   - Choose "Export as PNG" or "Export as PDF"
   - Save the file

2. Add the diagram to this repository:
   - Copy your exported diagram file to `docs/database/`
   - Recommended filename: `database-diagram.png` or `database-schema.png`
   - Commit the file to the repository

3. Update `docs/database/README.md` to reference your diagram file

## Step 4: Create Database Migrations

Based on your database diagram, create Laravel migrations for each table:

```bash
# Example migrations based on common book tracking requirements:
php artisan make:migration create_users_table
php artisan make:migration create_books_table
php artisan make:migration create_authors_table
php artisan make:migration create_categories_table
php artisan make:migration create_user_books_table
php artisan make:migration create_reviews_table
```

Each migration file will be created in `database/migrations/` with a timestamp prefix.

## Step 5: Define Migration Schema

Edit each migration file to define the table structure based on your diagram.

Example migration structure:
```php
public function up(): void
{
    Schema::create('books', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description')->nullable();
        $table->string('isbn')->unique()->nullable();
        $table->integer('pages')->nullable();
        $table->date('published_date')->nullable();
        $table->foreignId('author_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}
```

## Step 6: Run Migrations

Once your migrations are defined:

```bash
php artisan migrate
```

This will create all tables in your database according to the migration files.

## Step 7: Create Eloquent Models

Create models for each table to interact with your database:

```bash
php artisan make:model Book
php artisan make:model Author
php artisan make:model Category
php artisan make:model Review
```

Models will be created in `app/Models/` directory.

## Step 8: Define Model Relationships

In each model, define relationships based on your database diagram:

```php
// Example: Book model
class Book extends Model
{
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
```

## Step 9: Create Controllers

Generate controllers to handle API requests:

```bash
php artisan make:controller BookController --api
php artisan make:controller AuthorController --api
php artisan make:controller CategoryController --api
```

Controllers will be created in `app/Http/Controllers/` directory.

## Step 10: Define Routes

Add API routes in `routes/api.php`:

```php
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;

Route::apiResource('books', BookController::class);
Route::apiResource('authors', AuthorController::class);
```

## Next Steps

- Implement authentication (Laravel Sanctum or Passport)
- Add validation rules
- Create database seeders for testing
- Write tests
- Set up API documentation

## Useful Laravel Commands

```bash
# Create a migration
php artisan make:migration create_table_name

# Run migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Create a model
php artisan make:model ModelName

# Create a controller
php artisan make:controller ControllerName

# Create a seeder
php artisan make:seeder TableNameSeeder

# Run seeders
php artisan db:seed

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

## Getting Help

- [Laravel Documentation](https://laravel.com/docs)
- [Laravel API Resources](https://laravel.com/docs/eloquent-resources)
- [Laravel Database Migrations](https://laravel.com/docs/migrations)
- [Laravel Eloquent ORM](https://laravel.com/docs/eloquent)
