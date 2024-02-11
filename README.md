### Project Title: Vechile Management System

### Description:

This project is a simple vehicle management system. It is a console application that allows the user to add, delete, view vehicles and approval management

### Features:

Physical data model was included in the project to show the relationship between the tables. The project also includes a seeder file to populate the database with default data. The project also includes a factory file to generate fake data for the database. The project also includes a test file to test the application.

## Table of Contents

1. [Configuration](#configuration)
2. [Installation](#installation)
3. [Usage](#usage)

# Configuration

1. Install PHP 7.4 or higher
2. Install Composer
3. create a database and update the .env file with the database credentials
4. Run command `php artisan key:generate`

# Installation

1. Clone the repository
2. Open the project in Code Editor
3. Run command `composer install`
4. Run command `php artisan migrate --seed`
5. Run command `php artisan serve`

# Usage

1. Your application is now running on `http://http://127.0.0.1:8000/`
2. You must login to access the application, look at the table below for the default login credentials

| email          | password |
| -------------- | -------- |
| admin@vms.com  | 12345    |
| man_ro@vms.com | 12345    |
| man_ho@vms.com | 12345    |

3. You can access the Dashboard,and Vehicle page
4. You can add, delete, view vehicles and approval management
5. You can also view the vehicle details and approval management details
6. You can alse export the vehicle datat to a csv or pdf file
