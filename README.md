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

MAPBOX_TOKEN=pk.eyJ1Ijoic2phbWlsIiwiYSI6ImNtZ3lybm5seDAyNDAya3BzdnBpZHY3dXMifQ.5Hi_zT9Uavbameol5u5Qpw
```

6. Config file for mapbox 
```bash
php artisan vendor:publish --tag="mapbox-config"
```

7. Run migrations
```bash
php artisan migrate
```

8. Storage link
```bash
php artisan storage:link
```

9. Start the development server
```bash
php artisan serve
```

10. Akun admin
```bash
username: admin@bunihayu.com
password: Dede1234.
```

The application will be available at `http://localhost:8000`