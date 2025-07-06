# 📘 Smart Task Manager

A simple Laravel-based productivity tool that helps users create, update, categorize, and manage their daily assignments or tasks with deadlines and completion tracking.

---

## 🚀 Features

- ✅ User authentication (Login, Register, Logout)
- ✅ Add / Edit / Delete assignments
- ✅ Set deadlines for assignments
- ✅ Mark assignments as completed or pending
- ✅ Filter assignments by category or search query
- ✅ Categorize tasks (e.g., Work, Personal, Learning)

---

## 🛠 Tech Stack

- **Backend**: Laravel 11
- **Frontend**: Blade (no JS framework)
- **Auth**: Laravel Breeze (simple, secure user authentication)
- **Database**: MySQL / SQLite
- **Styling**: Plain HTML Bootstrap 

---

## 📦 Installation & Setup

1. **Clone the repo**
   ```bash
   git clone https://github.com/your-username/smart-task-manager.git
   cd smart-task-manager
````

2. **Install dependencies**

   ```bash
   composer install
   npm install && npm run dev
   ```

3. **Environment setup**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Set up database**

   * Configure `.env` for your DB (MySQL or SQLite)
   * Then run migrations:

     ```bash
     php artisan migrate
     ```

5. **Install and configure auth (Breeze)**
   Breeze is already installed. If not, run:

   ```bash
   composer require laravel/breeze --dev
   php artisan breeze:install
   npm install && npm run dev
   ```

6. **Start server**

   ```bash
   php artisan serve
   ```

7. **Access app**
   Open `http://localhost:8000` in your browser.

---

## 🧪 Test Credentials (Optional)

You can register a new user, or run `php artisan tinker` to create one manually:

```php
User::create([
    'name' => 'Test User',
    'email' => 'test@example.com',
    'password' => bcrypt('password')
]);
```

---

## 📂 Folder Structure Highlights

| File/Folder                                     | Purpose                                   |
| ----------------------------------------------- | ----------------------------------------- |
| `routes/web.php`                                | Web routes (includes assignments CRUD)    |
| `app/Models/Assignment.php`                     | Assignment model with relationships       |
| `app/Http/Controllers/AssignmentController.php` | Task logic (CRUD)                         |
| `resources/views/`                              | Blade views (`welcome`, `create`, `edit`) |
| `database/migrations/`                          | Tables for users, assignments, categories |

---

## 📝 Future Improvements

* [ ] Add assignment reminders via email
* [ ] Highlight overdue tasks
* [ ] Add mobile responsiveness (basic Tailwind or Bootstrap)
* [ ] Real-time sync (Laravel Echo / Pusher)
* [ ] Progressive Web App (PWA) support
* [ ] RESTful API version for mobile clients

---

## 👤 Author

Made by **Sheroz Shakir**
*Designed as a prototype productivity tool using Laravel Blade and simple auth.*

---

## 📃 License

This project is open-source and available under the [MIT License](LICENSE).

