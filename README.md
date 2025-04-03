# SoftContact

## Introduction
This project is developed using Laravel and follows best practices to ensure functionality and scalability. Please note that some comments or text within the code may be in Portuguese, as I am a Brazilian developer. I apologize for any inconvenience this may cause.

## Important Note on Database Design
In the database migrations, the `email` and `contact` columns are **not** set as `unique`. This design choice was made intentionally to allow multiple users to have the same contact information. However, within their own account, users can only register **one** unique contact. This ensures that while multiple users can share the same contact details, they cannot create duplicate contacts within their own account.

## Database Setup
After cloning the repository and installing dependencies, run the following commands to set up the database:
```sh
php artisan migrate:fresh
php artisan db:seed
```

This will reset the database and seed it with initial data, including three pre-registered users:
- **Admin User**
  - Email: `admin@mail.com`
  - Password: `admin@123`
- **Lucas Gabriel**
  - Email: `lucas@gmail.com`
  - Password: `Lucas@123`
- **Ana Raquel**
  - Email: `ana@gmail.com`
  - Password: `ana@123`

## Usage
Start the local development server:
```sh
php artisan serve
```

## Developer
This exercise was created by Lucas Gabriel.


