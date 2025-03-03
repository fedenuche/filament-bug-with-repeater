# Laravel Project Setup

Follow these steps to install and set up the Laravel project after cloning it from the repository.

## 🚀 Installation Steps

### 1️⃣ Clone the repository

```sh
git clone https://github.com/fedenuche/filament-bug-with-repeater
cd filament-bug-with-repeater
```

### 2️⃣ Install dependencies

```sh
composer install
```

### 3️⃣ Set up the environment file

```sh
cp .env.example .env
```

Then, update the `.env` file with your database credentials:

```
DB_HOST=127.0.0.1
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4️⃣ Generate the application key

```sh
php artisan key:generate
```

### 5️⃣ Set up the database

Run the migrations:

```sh
php artisan migrate --seed
```

### 6️⃣ Install Node.js dependencies (if required)

```sh
npm install
npm run dev  # or npm run build for production
```

### 7️⃣ Start the development server

```sh
php artisan serve
```

## Visit: [http://127.0.0.1:8000](http://127.0.0.1:8000)

🎉 **Your Laravel project is now set up and running!** 🚀
