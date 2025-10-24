# Database Diagram to Laravel Quick Reference

This document provides a quick reference for translating your dbdiagram.io schema into Laravel components.

## dbdiagram.io Syntax → Laravel Mapping

### 1. Table Definition

**dbdiagram.io:**
```
Table users {
  id int [pk, increment]
  username varchar(255) [unique, not null]
  email varchar(255) [unique, not null]
  created_at timestamp
}
```

**Laravel Migration:**
```php
Schema::create('users', function (Blueprint $table) {
    $table->id(); // Auto-incrementing primary key
    $table->string('username')->unique();
    $table->string('email')->unique();
    $table->timestamps(); // Creates created_at and updated_at
});
```

### 2. Foreign Keys / Relationships

**dbdiagram.io:**
```
Table books {
  id int [pk]
  author_id int [ref: > authors.id]
}

Table authors {
  id int [pk]
  name varchar
}
```

**Laravel Migration:**
```php
Schema::create('books', function (Blueprint $table) {
    $table->id();
    $table->foreignId('author_id')->constrained()->onDelete('cascade');
    $table->timestamps();
});
```

**Laravel Model (Book):**
```php
public function author()
{
    return $this->belongsTo(Author::class);
}
```

**Laravel Model (Author):**
```php
public function books()
{
    return $this->hasMany(Book::class);
}
```

### 3. Many-to-Many Relationships

**dbdiagram.io:**
```
Table books {
  id int [pk]
}

Table categories {
  id int [pk]
}

Table book_category {
  book_id int [ref: > books.id]
  category_id int [ref: > categories.id]
}
```

**Laravel Migration (Pivot Table):**
```php
Schema::create('book_category', function (Blueprint $table) {
    $table->foreignId('book_id')->constrained()->onDelete('cascade');
    $table->foreignId('category_id')->constrained()->onDelete('cascade');
    $table->primary(['book_id', 'category_id']);
});
```

**Laravel Model (Book):**
```php
public function categories()
{
    return $this->belongsToMany(Category::class);
}
```

**Laravel Model (Category):**
```php
public function books()
{
    return $this->belongsToMany(Book::class);
}
```

### 4. Common Data Types

| dbdiagram.io | Laravel Migration |
|--------------|-------------------|
| `int` | `$table->integer()` |
| `varchar` | `$table->string()` |
| `text` | `$table->text()` |
| `boolean` | `$table->boolean()` |
| `date` | `$table->date()` |
| `datetime` | `$table->dateTime()` |
| `timestamp` | `$table->timestamp()` |
| `decimal` | `$table->decimal()` |
| `json` | `$table->json()` |

### 5. Column Modifiers

| dbdiagram.io | Laravel Migration |
|--------------|-------------------|
| `[not null]` | `->nullable(false)` (default) |
| `[null]` | `->nullable()` |
| `[unique]` | `->unique()` |
| `[default: value]` | `->default(value)` |
| `[pk]` | `$table->id()` or `->primary()` |
| `[increment]` | Automatic with `id()` |

### 6. Indexes

**dbdiagram.io:**
```
Indexes {
  (email) [unique]
  (username, email)
}
```

**Laravel Migration:**
```php
$table->unique('email');
$table->index(['username', 'email']);
```

## Workflow Steps

1. **Export Diagram**: Save your dbdiagram.io diagram as an image
2. **Place in Repo**: Add to `docs/database/` directory
3. **Create Migrations**: `php artisan make:migration create_tablename_table`
4. **Define Schema**: Translate dbdiagram.io syntax to Laravel migrations
5. **Run Migrations**: `php artisan migrate`
6. **Create Models**: `php artisan make:model ModelName`
7. **Define Relationships**: Add relationship methods to models
8. **Create Controllers**: `php artisan make:controller ModelController --api`

## Example: Complete Flow

### Step 1: dbdiagram.io Schema
```
Table books {
  id int [pk, increment]
  title varchar(255) [not null]
  isbn varchar(20) [unique]
  author_id int [ref: > authors.id]
  published_date date
  created_at timestamp
  updated_at timestamp
}

Table authors {
  id int [pk, increment]
  name varchar(255) [not null]
  created_at timestamp
  updated_at timestamp
}
```

### Step 2: Create Migrations
```bash
php artisan make:migration create_authors_table
php artisan make:migration create_books_table
```

### Step 3: Define Migrations
```php
// create_authors_table.php
public function up()
{
    Schema::create('authors', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->timestamps();
    });
}

// create_books_table.php
public function up()
{
    Schema::create('books', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('isbn', 20)->unique()->nullable();
        $table->foreignId('author_id')->constrained()->onDelete('cascade');
        $table->date('published_date')->nullable();
        $table->timestamps();
    });
}
```

### Step 4: Create Models
```bash
php artisan make:model Author
php artisan make:model Book
```

### Step 5: Define Relationships
```php
// app/Models/Book.php
class Book extends Model
{
    protected $fillable = ['title', 'isbn', 'author_id', 'published_date'];
    
    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}

// app/Models/Author.php
class Author extends Model
{
    protected $fillable = ['name'];
    
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
```

## Tips

- Always create migrations in the correct order (parent tables before child tables)
- Use Laravel's built-in relationship methods for cleaner code
- Use `foreignId()` and `constrained()` for automatic foreign key creation
- Add indexes for frequently queried columns
- Use `timestamps()` to automatically add `created_at` and `updated_at`
- Consider soft deletes with `$table->softDeletes()` for important data

## Resources

- [Laravel Migrations](https://laravel.com/docs/migrations)
- [Laravel Eloquent Relationships](https://laravel.com/docs/eloquent-relationships)
- [dbdiagram.io Documentation](https://dbdiagram.io/docs)
