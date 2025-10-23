# Bunihayu Laravel Project

[![Watch the Demo](https://img.youtube.com/vi/BvvMfsrS6Wk/0.jpg)](https://www.youtube.com/watch?v=BvvMfsrS6Wk)

## Prerequisites
- PHP >= 8.0
- Composer
- MySQL
- XAMPP (or similar local development environment)

## Installation Steps

1. Clone the repository
```bash
git clone https://github.com/jamilsalsabila/bunihayu.git
cd bunihayu
```

2. Install dependencies
```bash
composer install
```

3. Generate application key
```bash
php artisan key:generate
```

4. Config file for mapbox 
```bash
php artisan vendor:publish --tag="mapbox-config"
```

5. Run migrations
```bash
php artisan migrate:fresh --seed
```

6. Storage link
```bash
php artisan storage:link
```

7. Start the development server
```bash
php artisan serve
```

8. Akun admin
```
username: admin@bunihayu.com
password: Dede1234.
```

The application will be available at `http://localhost:8000`

If a Laravel application is stuck loading the home page, do this:

1. Clear application cache
```bash
php artisan cache:clear
```

2. Clear configuration cache
```bash
php artisan config:clear
```

2. Clear view cache
```bash
php artisan view:clear
```