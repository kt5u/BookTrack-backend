# BookTrack Backend

A Laravel-based backend application for tracking books.

## Project Setup

This project is being developed with Laravel as the backend framework. The database structure is designed using [dbdiagram.io](https://dbdiagram.io).

## Database Diagram

The database diagram for this project can be found in the `docs/database/` directory. This diagram serves as the reference for:
- Creating database migrations
- Defining Eloquent models
- Setting up table relationships
- Planning the overall database structure

## Installation

1. Clone the repository:
```bash
git clone https://github.com/kt5u/BookTrack-backend.git
cd BookTrack-backend
```

2. Install dependencies:
```bash
composer install
```

3. Copy the environment file:
```bash
cp .env.example .env
```

4. Generate application key:
```bash
php artisan key:generate
```

5. Configure your database in the `.env` file:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=booktrack
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. Run migrations (once created):
```bash
php artisan migrate
```

## Development

This project is in the initial development phase. The database diagram in `docs/database/` will be used as a reference to create:
- Database migrations
- Eloquent models
- Controllers
- API endpoints

## Documentation

- Database documentation: `docs/database/README.md`
- Database diagram: Add your dbdiagram.io export to `docs/database/`

## Requirements

- PHP >= 8.2
- Composer
- MySQL/MariaDB or PostgreSQL
- Laravel 11.x

## License

This project is licensed under the Apache License 2.0 - see the LICENSE file for details.