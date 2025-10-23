# Bunihayu Laravel Project

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

3. Create environment file
```bash
cp .env.example .env
```

4. Generate application key
```bash
php artisan key:generate
```

5. Config file for mapbox 
```bash
php artisan vendor:publish --tag="mapbox-config"
```

6. Run migrations
```bash
php artisan migrate:fresh --seed
```

7. Storage link
```bash
php artisan storage:link
```

8. Start the development server
```bash
php artisan serve
```

9. Akun admin
```
username: admin@bunihayu.com
password: Dede1234.
```

The application will be available at `http://localhost:8000`