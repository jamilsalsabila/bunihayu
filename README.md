# Bunihayu Laravel Project

## Prerequisites
- PHP >= 8.0
- Composer
- MySQL
- XAMPP (or similar local development environment)

## Installation Steps

1. Clone the repository
```bash
git clone [repository-url]
cd bunihayu
```

2. Install dependencies
```bash
composer install
```

3. Create environment file
```bash
cp .env.example .env
```

4. Generate application key
```bash
php artisan key:generate
```

5. Configure database in `.env` file
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bunihayu
DB_USERNAME=root
DB_PASSWORD=
```

6. Run migrations
```bash
php artisan migrate
```

7. Start the development server
```bash
php artisan serve
```

8. Storage link
```bash
php artisan storage:link
```

The application will be available at `http://localhost:8000`