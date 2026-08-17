# 📋 Task Management System

A complete **Mini Task & Project Management System** built with Laravel. This application allows registered users to manage their projects and tasks efficiently with a clean, responsive, and professional interface.

---

## 📌 Project Overview

This is a **Full-Stack Laravel Application** built as a 3-4 day internship project. It demonstrates practical understanding of:

- ✅ User Authentication (Register, Login, Logout)
- ✅ Project Management (CRUD operations)
- ✅ Task Management (CRUD with status and priority)
- ✅ Database Relationships (Eloquent ORM)
- ✅ Server-side Validation
- ✅ Authorization (User-specific data access)
- ✅ Modern, Responsive UI
- ✅ Professional Dashboard with Charts

---

## 🚀 Features

### 🔐 Authentication
- User Registration with validation
- User Login with secure authentication
- User Logout
- Password hashing using Laravel's standard mechanisms
- Authentication middleware for protected routes

### 📊 Dashboard
- Display logged-in user's name
- Show total projects, tasks, completed, pending, and in-progress counts
- Quick links to create projects and view projects
- Professional charts (Line Chart & Pie Chart)
- Recent projects and tasks overview

### 📁 Project Management
- Create projects with: Name, Description, Start Date, End Date, Status
- View a list of user's projects
- View project details with tasks
- Edit project details
- Delete projects with confirmation
- Search and filter projects
- Pagination (6 projects per page)
- Prevent users from accessing another user's projects

### 📋 Task Management
- Create tasks under a project
- Task fields: Title, Description, Due Date, Priority, Status
- View tasks belonging to a project
- Edit task details
- Delete tasks with confirmation
- Update task status
- Due date indicators (Overdue, Today, This Week)
- Task priority badges
- Prevent users from managing tasks belonging to another user's project

### 🎁 Bonus Features
- Search and filter projects/tasks
- Pagination
- Task priority badges and due-date indicators
- AJAX/Fetch-based status updates
- Soft deletes
- Simple activity log
- Email notification for overdue tasks
- Dark/Light mode toggle
- Professional charts

---

## 🛠️ Tech Stack

| Technology | Purpose |
|------------|---------|
| **Laravel** | PHP Framework |
| **MySQL** | Database |
| **Blade** | Templating Engine |
| **Bootstrap 5** | Frontend Framework |
| **Tailwind CSS** | Utility-first CSS |
| **Font Awesome** | Icons |
| **Chart.js** | Charts and Graphs |
| **SweetAlert2** | Beautiful Alerts |

---

## 📁 Project Structure

```
task-management-system/
├── app/
│   ├── Console/
│   │   └── Commands/
│   │       └── CheckOverdueTasks.php
│   ├── Helpers/
│   │   └── ActivityHelper.php
│   ├── Http/
│   │   └── Controllers/
│   │       ├── ProjectController.php
│   │       └── TaskController.php
│   ├── Mail/
│   │   └── TaskOverdueMail.php
│   └── Models/
│       ├── Project.php
│       ├── Task.php
│       └── Activity.php
├── database/
│   ├── migrations/
│   │   ├── create_projects_table.php
│   │   ├── create_tasks_table.php
│   │   └── create_activities_table.php
│   └── seeders/
│       └── DemoUserSeeder.php
├── resources/
│   └── views/
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── emails/
│       │   └── task-overdue.blade.php
│       ├── layouts/
│       │   ├── app.blade.php
│       │   ├── dashboard.blade.php
│       │   ├── navigation.blade.php
│       │   └── sidebar.blade.php
│       ├── projects/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── show.blade.php
│       ├── tasks/
│       │   ├── create.blade.php
│       │   └── edit.blade.php
│       └── dashboard.blade.php
└── routes/
    └── web.php
```

---

## 📋 Database Schema

### Users Table
| Field | Type | Description |
|-------|------|-------------|
| id | bigint | Primary Key |
| name | string | User's full name |
| email | string | User's email (unique) |
| password | string | Hashed password |
| timestamps | timestamp | Created/Updated at |

### Projects Table
| Field | Type | Description |
|-------|------|-------------|
| id | bigint | Primary Key |
| user_id | foreignId | References users table |
| name | string | Project name |
| description | text | Project description |
| start_date | date | Project start date |
| end_date | date | Project end date |
| status | enum | pending/in_progress/completed |
| deleted_at | timestamp | Soft delete timestamp |
| timestamps | timestamp | Created/Updated at |

### Tasks Table
| Field | Type | Description |
|-------|------|-------------|
| id | bigint | Primary Key |
| project_id | foreignId | References projects table |
| title | string | Task title |
| description | text | Task description |
| due_date | date | Task due date |
| priority | enum | low/medium/high |
| status | enum | pending/in_progress/completed |
| deleted_at | timestamp | Soft delete timestamp |
| timestamps | timestamp | Created/Updated at |

---

## 🔧 Installation

### 1. Clone the Repository
```bash
git clone <repository-url>
cd task-management-system
```

### 2. Install Dependencies
```bash
composer install
npm install
npm run build
```

### 3. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure Database

**For SQLite (Recommended for testing):**
```env
DB_CONNECTION=sqlite
```

Create database file:
```bash
# Windows
New-Item -Path "database\database.sqlite" -ItemType File

# Linux/Mac
touch database/database.sqlite
```

**For MySQL:**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_management_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Run Migrations & Seeders
```bash
php artisan migrate
php artisan db:seed --class=DemoUserSeeder
```

### 6. Start Development Server
```bash
php artisan serve
```

### 7. Access the Application
```
http://localhost:8000
```

---

## 👤 Demo Credentials

| Field | Value |
|-------|-------|
| **Email** | `demo@example.com` |
| **Password** | `password123` |

---

## 📸 Screenshots

### Dashboard
![Dashboard](screenshots/dashboard.png)

### Login Page
![Login](screenshots/login.png)

### Projects List
![Projects](screenshots/projects.png)

### Project Details
![Project Details](screenshots/project-details.png)

### Create Project
![Create Project](screenshots/create-project.png)

### Edit Project
![Edit Project](screenshots/edit-project.png)

---

## 🎯 Routes

| Method | URI | Name | Description |
|--------|-----|------|-------------|
| GET | / | - | Redirects to login |
| GET | /login | login | Show login form |
| POST | /login | login | Handle login |
| GET | /register | register | Show register form |
| POST | /register | register | Handle registration |
| POST | /logout | logout | Handle logout |
| GET | /dashboard | dashboard | Dashboard view |
| GET | /projects | projects.index | List all projects |
| GET | /projects/create | projects.create | Create project form |
| POST | /projects | projects.store | Store project |
| GET | /projects/{id} | projects.show | View project details |
| GET | /projects/{id}/edit | projects.edit | Edit project form |
| PUT | /projects/{id} | projects.update | Update project |
| DELETE | /projects/{id} | projects.destroy | Delete project |
| PATCH | /projects/{id}/restore | projects.restore | Restore project |
| DELETE | /projects/{id}/force-delete | projects.forceDelete | Permanently delete |
| GET | /tasks/create | tasks.create | Create task form |
| POST | /tasks | tasks.store | Store task |
| GET | /tasks/{id}/edit | tasks.edit | Edit task form |
| PUT | /tasks/{id} | tasks.update | Update task |
| DELETE | /tasks/{id} | tasks.destroy | Delete task |
| PATCH | /tasks/{task}/status | tasks.updateStatus | Update task status (AJAX) |

---

## 🔒 Security Features

- ✅ Password hashing
- ✅ Authentication middleware
- ✅ CSRF protection
- ✅ Server-side validation
- ✅ Authorization (user-specific data)
- ✅ Soft deletes

---

## 📧 Email Notifications

Overdue task notifications are sent automatically:

```bash
# Run manually
php artisan tasks:check-overdue

# Scheduled automatically (hourly)
# Configured in app/Console/Kernel.php
```

---

## 🧪 Testing Checklist

- [ ] Register with valid/invalid data
- [ ] Login with valid/invalid credentials
- [ ] Logout successfully
- [ ] Create, edit, view, and delete projects
- [ ] Create, edit, view, and delete tasks
- [ ] Verify validation errors are displayed clearly
- [ ] Verify one user cannot access another user's data
- [ ] Verify the application works on desktop and mobile

---

## 🤝 Contributing

1. Fork the repository
2. Create a new branch (`git checkout -b feature/your-feature`)
3. Commit your changes (`git commit -m 'Add some feature'`)
4. Push to the branch (`git push origin feature/your-feature`)
5. Open a Pull Request

---

## 📝 License

This project is licensed under the MIT License.

---

## 🙏 Acknowledgments

- [Laravel](https://laravel.com)
- [Bootstrap](https://getbootstrap.com)
- [Tailwind CSS](https://tailwindcss.com)
- [Font Awesome](https://fontawesome.com)
- [Chart.js](https://www.chartjs.org)

---

## 📧 Contact

For any questions or feedback, please contact the project maintainer.

---

**Happy Coding!** 🚀



<img src="/screenshot.dashbaord.png">