

## 🚀 Project Setup Instructions

Follow the steps below to set up the project on your local machine.

### 1. Configure Environment Variables

Update your `.env` file with the correct database settings:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=spiderwebbackend
DB_USERNAME=root
DB_PASSWORD=

2. Install PHP Dependencies
Run the following command to install all required PHP dependencies:
composer install

3. Run Database Migrations and Seeders
To reset your database and seed it with sample data, run:
php artisan migrate:fresh --seed
