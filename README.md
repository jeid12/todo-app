<p align="center">
    <img src="https://laravel.com/img/logomark.min.svg" alt="Laravel Logo" width="100">
    <img src="https://breeze.laravel.com/img/breeze-logo.svg" alt="Laravel Breeze Logo" width="100">
    <img src="https://upload.wikimedia.org/wikipedia/commons/9/9a/Laravel_Blade_logo.svg" alt="Blade Logo" width="100">
</p>

# Todo Application

## About the Project
The **Todo Application** is a Laravel-based project designed to help users manage their daily tasks efficiently. It provides a seamless experience for creating, viewing, updating, and deleting tasks. The application is built with modern web development practices, leveraging Laravel Breeze for authentication and Sanctum for API token management. The project supports both web and API interfaces, making it versatile for different use cases.

### Key Features
- **Task Management**: Users can create, view, update, and delete their own tasks.
- **Task Completion**: Mark tasks as completed and track their status.
- **Validation**: Real-time validation for task creation and updates.
- **Authentication**: Secure authentication using Laravel Breeze.
- **API Support**: Fully functional API for task management.
- **Responsive Design**: Web interface designed with Tailwind CSS for a modern look.

---

## Getting Started

### Prerequisites
Ensure you have the following installed:
- PHP >= 8.1
- Composer
- Node.js & npm
- MySQL or any supported database

### Installation
1. Clone the repository:
   ```bash
   git clone <repository-url>
   cd todo-app
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install JavaScript dependencies:
   ```bash
   npm install
   ```

4. Build frontend assets:
   ```bash
   npm run build
   ```

5. Set up the environment file:
   ```bash
   cp .env.example .env
   ```
   Update the `.env` file with your database credentials.

6. Generate the application key:
   ```bash
   php artisan key:generate
   ```

7. Run migrations:
   ```bash
   php artisan migrate
   ```

8. Seed the database (optional):
   ```bash
   php artisan db:seed
   ```

9. Start the development server:
   ```bash
   php artisan serve
   ```

---

## Usage

### Web Interface
1. Visit the application in your browser at `http://localhost:8000`.
2. Register or log in to manage your tasks.
3. Use the dashboard to create, view, update, and delete tasks.

### API Interface
The API supports the following endpoints:

| Method | Endpoint               | Description              |
|--------|------------------------|--------------------------|
| POST   | `/api/login`           | Log in a user            |
| POST   | `/api/register`        | Register a new user      |
| GET    | `/api/todos`           | List all tasks           |
| POST   | `/api/todos`           | Create a new task        |
| PUT    | `/api/todos/{id}`      | Update a task            |
| DELETE | `/api/todos/{id}`      | Delete a task            |
| POST   | `/api/todos/{id}/complete` | Mark a task as complete |

#### Authentication
Use Sanctum for API authentication. After logging in, include the token in the `Authorization` header:
```
Authorization: Bearer <token>
```

---

### Database
This project uses SQLite as the default database for simplicity and ease of setup. To configure the database:
1. Ensure the `.env` file has the following settings:
   ```env
   DB_CONNECTION=sqlite
   DB_DATABASE=/absolute/path/to/database.sqlite
   ```
2. Create the SQLite database file if it doesn't exist:
   ```bash
   touch database/database.sqlite
   ```
3. Run migrations to set up the database schema:
   ```bash
   php artisan migrate
   ```

---

### Web and API Interfaces
The application provides two interfaces:

#### Web Interface
- Built with Laravel Blade templates and Tailwind CSS.
- Includes user authentication via Laravel Breeze.
- Features a responsive design for seamless use on all devices.

#### API Interface
- Built with Laravel Sanctum for secure token-based authentication.
- Provides endpoints for managing tasks programmatically.
- Ideal for integration with third-party applications or mobile clients.

---

## About the Creator
This project was created by **NIYOKWIZERA JEAN D'AMOUR**, a passionate software developer with expertise in Laravel and modern web development. For inquiries or collaborations, feel free to reach out via email at `niyokwizerajd123@gmail.com` or via phone `+250784422138`.

---

## License
This project is open-source and available under the [MIT License](LICENSE).
