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

## Visit: [http://localhost:8000](http://localhost:8000)

🎉 **Your Laravel project is now set up and running!** 🚀

# How to reproduce the error

### 1️⃣ Login to the dashboard

Go to the [dashboard](http://localhost:8000/dashboard/)
User: admin@test.com
Password: password

### 2️⃣ Go to lessons

Edit any lesson, for example the [lesson one](http://localhost:8000/dashboard/lessons/1/edit)


### 3️⃣ Add more than one Vocabulary

Using the repeater add more than one vocabulary and press save.

Only one of them will be shown!
