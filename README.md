# Laravel Base Start

A Laravel 5.8 starter kit designed to provide a solid foundation for new web applications. It comes pre-configured with user authentication, an AdminLTE 2 backend theme, role-based access control, and more.

## Features

*   Built on Laravel 5.8 framework.
*   AdminLTE 2 for a responsive and feature-rich backend interface.
*   User management (Create, Read, Update, Delete users).
*   Role-based access control (pre-configured 'admin' and 'user' roles, managed via `role_id` on the `users` table).
*   Data presentation with `leantony/laravel-grid`.
*   Backend log viewer for easier debugging.
*   Includes example pages and dashboard.

## Prerequisites

*   PHP >= 7.1.3
*   Composer
*   NPM (Node Package Manager) or Yarn for frontend asset management.
*   A database server (e.g., MySQL, PostgreSQL, SQLite).

## Installation

1.  Clone the repository: `git clone https://github.com/your-username/laravel-base-start.git # Replace with your actual repository URL`
2.  Navigate into the project directory: `cd laravel-base-start`
3.  Install PHP dependencies: `composer install`
4.  Create your environment file: `cp .env.example .env`
5.  Generate an application key: `php artisan key:generate`
6.  Configure your database credentials (DB_DATABASE, DB_USERNAME, DB_PASSWORD, etc.) and mail driver settings in the `.env` file.
7.  Run database migrations: `php artisan migrate`
    *   Note: The base project does not include a seeder for default users. You will need to create users manually after installation (see Usage section).
8.  Install frontend dependencies: `npm install` (or `yarn install`)
9.  Compile frontend assets:
    *   For development: `npm run dev` (or `yarn dev`)
    *   For production: `npm run prod` (or `yarn prod`)
10. Start the development server: `php artisan serve`
11. The application should now be accessible at `http://localhost:8000` by default.

## Usage/Demo

*   Access the application by navigating to `http://localhost:8000` (or the URL provided by `php artisan serve`).

*   **Creating an Admin User:**
    Since no default admin user is seeded, you'll need to create one:
    1.  **Register a new user:** Use the application's registration form (`/register`) to create a new user account.
    2.  **Assign Admin Role:**
        *   Connect to your application using Tinker: `php artisan tinker`
        *   Find the user you just created (e.g., by email):
            ```php
            $user = App\Models\User::where('email', 'your-email@example.com')->first();
            ```
        *   Set their `role_id` to `1`. This ID is commonly used for the 'admin' role in such setups:
            ```php
            $user->role_id = 1;
            $user->save();
            ```
        *   Exit Tinker: `exit`
    3.  Log out and log back in with this user. You should now have admin privileges.
    *   *(Note: This guide assumes `role_id = 1` corresponds to the 'admin' role, a common convention. The `app/Http/Middleware/Role.php` attempts to use `isAdmin()` and `hasRole()` methods on the User model, which are not currently defined in `app/Models/User.php`. Setting `role_id` directly is the current workaround for assigning roles.)*

*   **Admin Panel:** Once logged in with an admin user, the admin area and features should be accessible (typically via a dashboard link).
*   Explore the user management features and other functionalities available in the dashboard.

## Contributing

Contributions are welcome! Please follow these steps:

1.  Fork the repository.
2.  Create a new branch (`git checkout -b feature/your-feature-name`).
3.  Make your changes.
4.  Commit your changes (`git commit -am 'Add some feature'`).
5.  Push to the branch (`git push origin feature/your-feature-name`).
6.  Create a new Pull Request.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
