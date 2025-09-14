<?php
class StudentController
{
    private $model;

    // Constructor to initialize the model
    public function __construct($database) // __construct is a special method that is automatically called when an object of the class is created. It is typically used to initialize properties or perform setup tasks.
    {
        $this->model = new Student($database);  // this used to initialize the model property with a new instance of the Student model
    }

    // List all students
    public function listAction()
    {
        // Get all students from model; getAllStudents() method called from model
        $students = $this->model->getAllStudents();
        // Loads the view file responsible for displaying the student list.
        include 'views/students/list.php';
        // The `include` statement imports and executes the specified file at runtime.
        // If the file is missing, PHP will show a warning but continue execution.

    }

    // View a specific student
    public function viewAction($id)
    {
        // Get specific student; getStudentById($id) method called from model
        $student = $this->model->getStudentById($id);
        // Loads the view file responsible for displaying the student details.
        include 'views/students/view.php';
    }

    // Add a new student
    public function addAction($unused = null) // $unused = null to avoid error if called with an id means it can be called with or without an argument
    {
        $error = null;
        // If form submitted, try to insert
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? ''); // The null coalescing operator (??) is used to check if a variable is set and not null. If it is not set or is null, it returns the value on its right side.
            $email = trim($_POST['email'] ?? '');

            if ($name === '' || $email === '') {
                $error = 'Name and Email are required.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Please enter a valid email address.';
            } else {
                try {
                    // Attempt to add the student; addStudent() method called from model
                    $ok = $this->model->addStudent(['name' => $name, 'email' => $email]); // $ok will be true if insertion was successful
                    if ($ok) {
                        // Redirect back to list
                        header('Location: index.php?controller=student&action=list'); // if the addition is successful, the user is redirected to the student list page
                        // ?controller=student&action=list is a query string used to pass parameters to the server
                        // It tells the application to use the StudentController and call the listAction method.
                        exit; // exit statement is used to stop further script execution.
                    } else {
                        $error = 'Failed to add student.';
                    }
                } catch (Exception $e) {
                    $error = 'Error: ' . $e->getMessage();
                }
            }
        }

        // After processing the form submission (success or failure),
        // load the "add student" form view again.
        // - If adding was successful → the user is redirected before this point, so this won't run.
        // - If validation failed or no form was submitted yet → the form is shown again,
        //   with any error messages (from $error) passed to the view.
        include 'views/students/add.php';
    }

    // Edit an existing student
    public function editAction($id)
    {
        if (!$id) {
            header('Location: index.php?controller=student&action=list');
            exit;
        }

        $error = null;
        $student = $this->model->getStudentById($id);

        // Check if student exists
        if (!$student) {
            $error = 'Student not found.';
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');

            if ($name === '' || $email === '') {
                $error = 'Name and Email are required.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Please enter a valid email address.';
            } else {
                try {
                    $ok = $this->model->updateStudent($id, ['name' => $name, 'email' => $email]); // $ok will be true if update was successful
                    if ($ok) {
                        header('Location: index.php?controller=student&action=list'); // if the update is successful, the user is redirected to the student list page
                        exit; // exit from the editAction method to prevent further code execution
                    } else {
                        $error = 'Failed to update student.';
                    }
                } catch (Exception $e) {
                    $error = 'Error: ' . $e->getMessage();
                }
            }
            // Refresh student data with previous values on validation failure.
            $student = ['id' => $id, 'name' => $name, 'email' => $email];
        }

        include 'views/students/edit.php';
    }

    // Delete a student
    public function deleteAction($id)
    {
        if (!$id) {
            header('Location: index.php?controller=student&action=list'); // if no id provided, redirect to list
            exit;
        }

        $error = null;
        $student = $this->model->getStudentById($id); // Fetch student to confirm deletion

        if (!$student) {
            $error = 'Student not found.';
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $ok = $this->model->deleteStudent($id); // Attempt to delete the student; deleteStudent() method called from model
                if ($ok) {
                    header('Location: index.php?controller=student&action=list'); // if deletion successful, redirect to list
                    exit;
                } else {
                    $error = 'Failed to delete student.';
                }
            } catch (Exception $e) {
                $error = 'Error: ' . $e->getMessage();
            }
        }

        include 'views/students/delete.php'; // Show delete confirmation form
    }
}
