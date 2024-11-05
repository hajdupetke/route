# Route

Route is an assignment management application designed to simplify the workflow of managing assignments and tasks.

## Installation

Follow these steps to set up Route on your local machine:

### Prerequisites

Ensure you have the following installed on your machine:

-   [PHP](https://www.php.net/) (version 8.0 or higher)
-   [Composer](https://getcomposer.org/)
-   [Laravel](https://laravel.com/) (version 9.x or higher)
-   [Node.js](https://nodejs.org/) (version 14.x or higher) and npm (Node package manager)
-   A database server (e.g., MySQL, SQLite)

### Step 1: Clone the Repository

Clone the repository to your local machine using Git:

```bash
git clone https://github.com/hajdupetke/route.git
cd route
```

### Step 2: Install Dependencies

Install the PHP dependencies using Composer:

```bash
composer install
```

Install the Node.js dependencies:

```bash
npm install
```

### Step 3: Set Up Environment File

Copy the example environment file and update the necessary configurations:

```bash
cp .env.example .env
```

Edit the `.env` file and set your database and application configurations. For example:

```env
APP_NAME=Route
APP_ENV=local
APP_KEY=base64:yourbase64key
APP_DEBUG=true
APP_URL=http://localhost
```

### Step 4: Generate Application Key

Generate the application key:

```bash
php artisan key:generate
```

### Step 5: Run Migrations

Run the migrations to set up the database schema:

```bash
php artisan migrate
```

### Step 6: Seed the Database

Run the Database seeder to fill up the database with fake data:

```bash
php artisan db:seed
```

### Step 7: Compile Assets

Compile your JavaScript and CSS assets:

```bash
npm run dev
```

### Step 8: Run mail server

Start the mail server docker instance:

```bash
docker-compose up
```

### Step 9: Serve the Application

Start the development server:

```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser to access the application.

## Usage

Once the application is running, you can create, manage, and track assignments through the user-friendly dashboard. Sign up or log in to get started!

If you ran the Database Seeder, there will be an Admin user created with this credentials:
Email: admin@admin.com
Password: AdminPassword
