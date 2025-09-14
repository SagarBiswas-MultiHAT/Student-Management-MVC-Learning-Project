# Student Management (MVC Learning Project)

A tiny PHP MVC project built to learn and visualize the Model–View–Controller pattern end‑to‑end. It uses plain PHP with PDO, a simple router in `index.php`, and a minimal UI to manage students (CRUD).

## Why this exists

- Show the separation of concerns in MVC: Models (data), Views (UI), Controllers (flow)
- Be small enough to read in one sitting, but complete enough to be useful
- Stay dependency‑free: no frameworks, just PDO and a couple of files

## What you’ll learn

- Front Controller pattern with a simple query‑string router
- PDO prepared statements and basic error handling
- View rendering and passing data from controllers to views
- A typical MVC folder structure you’ll see in larger apps

## Quick start (XAMPP on Windows)

1. Place the project under your XAMPP docroot

   - Path used in this repo: `C:\xampp\htdocs\student_management`

2. Create the database and table

   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Run the SQL in `setup.sql`

3. Configure DB connection (optional)

   - Edit `config/database.php` if your MySQL user/password differ

4. Run the app
   - http://localhost/student_management/index.php
   - Safety-check variant: http://localhost/student_management/indexWithSafetyChecks.php

## Project structure

```
student_management/
├── index.php                      # Front controller and minimal router
├── indexWithSafetyChecks.php      # Same router with friendly safeguards
├── setup.sql                      # DB schema and optional seed data
├── styles.css                     # Minimal styling for the views
├── config/
│   └── database.php               # PDO connection (ERRMODE_EXCEPTION enabled)
├── controllers/
│   └── StudentController.php      # Orchestrates requests and selects views
├── models/
│   └── Student.php                # Data access layer (CRUD via PDO)
└── views/
		└── students/
				├── list.php               # List all students
				├── add.php                # Create form
				├── edit.php               # Update form
				├── view.php               # Details page
				└── delete.php             # Delete confirmation
```

## How routing works (Front Controller)

- All requests go through `index.php`.
- Two query parameters choose the target: `controller` and `action`.
  - Default controller: `student`
  - Default action: `list`
- The controller class is constructed and the method `<action>Action` is invoked.

## Examples

- List: `/index.php` → StudentController::listAction()
- Add: `/index.php?controller=student&action=add`
- Edit: `/index.php?controller=student&action=edit&id=5`
- View: `/index.php?controller=student&action=view&id=3`
- Delete:`/index.php?controller=student&action=delete&id=2`

## MVC responsibilities at a glance

- Model (`models/Student.php`)

  - Talks to MySQL with prepared statements
  - Methods: getAllStudents, getStudentById, addStudent, updateStudent, deleteStudent

- Controller (`controllers/StudentController.php`)

  - Validates input and coordinates model + views
  - Sends data to the appropriate view with `include`
  - Redirects after successful mutations
  - Friendly errors: converts DB duplicate‑key (SQLSTATE 23000 / MySQL 1062) into a clean
    message like “This email is already registered.”

- Views (`views/students/*.php`)
  - Minimal PHP/HTML templates for each page
  - Escape output with `htmlspecialchars` for safety

## Database schema (MySQL)

From `setup.sql`:

```
students
	id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY
	name        VARCHAR(100) NOT NULL
	email       VARCHAR(150) NOT NULL UNIQUE
	created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	updated_at  TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP
```

## Notable implementation details

- PDO is configured with `ERRMODE_EXCEPTION`, so DB issues throw `PDOException`.
- Server-side validation checks required fields and email format.
- Duplicate email attempts are handled gracefully in the controller with a user‑friendly message.
- `indexWithSafetyChecks.php` guards against missing files/classes/methods and shows clearer errors for learners.

## Common gotchas & troubleshooting

- “SQLSTATE[HY000] [1045] Access denied…”
  - Update credentials in `config/database.php`.
- “Base table or view not found: students”
  - Run `setup.sql` and ensure the active DB is `student_management`.
- “Duplicate entry for key 'email'”
  - This is expected when reusing an existing email; the UI now shows a clearer message.
- Blank page or 500 error
  - Use `indexWithSafetyChecks.php` to get a friendlier hint about what’s missing.

## Extending the app

- Add pagination or search to the list view
- Add CSRF tokens and more robust validation
- Introduce a simple router class instead of query strings
- Extract a base controller and basic view renderer for reusability

## License

MIT — do whatever, attribution welcome.
