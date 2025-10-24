# Contributing to BookTrack Backend

Thank you for considering contributing to BookTrack Backend!

## Development Workflow

1. **Fork and Clone**: Fork the repository and clone it locally
2. **Install Dependencies**: Run `composer install`
3. **Configure Environment**: Copy `.env.example` to `.env` and configure
4. **Check Database Diagram**: Review the diagram in `docs/database/`
5. **Create Migrations**: Based on the database diagram
6. **Write Tests**: Add tests for new features
7. **Submit PR**: Create a pull request with your changes

## Database Development

This project uses a database diagram from dbdiagram.io as the source of truth for the database schema. When making database changes:

1. **Update the Diagram First**: Make changes in dbdiagram.io
2. **Export Updated Diagram**: Export and replace the diagram in `docs/database/`
3. **Create/Update Migrations**: Reflect changes in Laravel migrations
4. **Update Models**: Update Eloquent models if relationships change
5. **Test Changes**: Ensure migrations work and tests pass

## Code Style

This project follows Laravel coding standards:
- Use PSR-12 coding style
- Follow Laravel naming conventions
- Write descriptive commit messages
- Add comments for complex logic
- Keep methods focused and small

## Creating Migrations

When creating new migrations:

```bash
php artisan make:migration create_tablename_table
```

Follow the mapping guide in `docs/database/LARAVEL_MAPPING.md` to translate the database diagram to Laravel migrations.

## Testing

Run tests before submitting:

```bash
composer test
# or
php artisan test
```

## Pull Request Process

1. Update documentation if needed
2. Add/update tests for your changes
3. Ensure all tests pass
4. Update the CHANGELOG if applicable
5. Reference any related issues in the PR description

## Questions?

Feel free to open an issue for discussion before making large changes.
