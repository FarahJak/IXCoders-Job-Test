# Laravel Application Setup Guide

This guide provides instructions on how to set up and run the Laravel application from this GitHub repository.

### Installation Steps:
-  Step 1: Clone the Repository.
  ```bash
   git clone <repository-url>
   cd <repository-folder>
  ```
-  Step 2: Install Dependencies:
   Run the following command to install PHP dependencies:
  ```bash
   composer install
  ```
-  Step 3: Set Up Environment Variables.
  - Copy the .env.example file to .env:
     ```bash
     copy .env.example .env
     ```
  - Generate Application Key:
     ```bash
     php artisan key:generate
     ```
  - Run Migrations and Seed the Database:
     ```bash
     php artisan migrate --seed
     ```
  - Run Migrations and Seed the Database:
     ```bash
     php artisan migrate --seed
     ```
  - Start the Development Server:
     ```bash
     php artisan serve
     ```
  - Compile Assets:
     ```bash
     npm run dev
     ```
-  Step 4: You can access the Dashboard will be accessible at [http://localhost:8000/](http://127.0.0.1:8000/login)

  - you can use this credintial to login:
      email: user@test.com
      password :123456789
-  Step 5: You can access Users Managment section at: [http://127.0.0.1:8000/admin/users](http://127.0.0.1:8000/admin/users)
-  Step 6: You can access Tasks Managment section at: [http://127.0.0.1:8000/admin/tasks](http://127.0.0.1:8000/admin/tasks)
-  Step 7: The image below is showing the Real-Time Notifications using pusher whenever a task's status is updated:
  ![photo_2024-12-03_20-58-12](https://github.com/user-attachments/assets/d1957244-422e-4eb7-9e79-aefc697e7169)
-  Step 8: File attached for Postman collection for the Api Endpoints:

  
  
