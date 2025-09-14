<?php
// Include configuration
require_once 'config/database.php';

// Get controller and action from URL
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'student'; // if no controller is specified, default to 'student'
$action = isset($_GET['action']) ? $_GET['action'] : 'list'; // if no action is specified, default to 'list'
// how to set specified controller and action? by URL query parameters ?controller=student&action=add

/* Test default value: 

        Only controller is set          : http://localhost/student_management/index.php?controller=student
        Only action is set              : http://localhost/student_management/index.php?action=add
        No controller or action is set  : http://localhost/student_management/index.php
*/

/* Example URLs to access different functionalities by id:

        Edit student with ID 5      : http://localhost/student_management/index.php?controller=student&action=edit&id=5
        View student with ID 3      : http://localhost/student_management/index.php?controller=student&action=view&id=5
        Delete student with ID 2    : http://localhost/student_management/index.php?controller=student&action=delete&id=5
*/

// Load appropriate controller -- It loads immediately when index.php executes.
// require_once is used to include and evaluate the specified file during the execution of the script
require_once "controllers/{$controller}Controller.php"; // e.g., controllers/StudentController.php
// Load model
// ucfirst() function is used to convert the first character of a string to uppercase
require_once "models/" . ucfirst($controller) . ".php"; // e.g., models/Student.php

/*
Purpose of require_once: 
    require_once tells PHP: “Before running the rest of the script, go fetch this file and include its code here.”
So when you do:
        require_once "controllers/{$controller}Controller.php";
        require_once "models/" . ucfirst($controller) . ".php";
#). PHP literally copies the code from those files into index.php at runtime.
#). Without this, PHP would have no idea what StudentController or Student is, and you’d get a “class not found” error when you try to do: 
        $controllerObj = new $controllerName($database);

Why load them here?
Because in MVC:
    Controllers contain the methods (listAction, addAction, etc.).
    Models contain the database logic (getAllStudents, addStudent, etc.).
Your index.php is the entry point (the front controller).
It decides:
        1. Which controller class file is needed (StudentController).
        2. Which model class file is needed (Student).
        3. Loads them into memory with require_once.
        4. Creates the controller object and runs the chosen method.

Think of it like a toolbox:
    #). index.php is the worker.
    #). require_once is opening the toolbox.
    #). Controllers and Models are the actual tools.
    #). If you don’t open the toolbox, the worker (PHP) has no tools to do the job → error.
*/

// Initialize controller and call action
$controllerName = ucfirst($controller) . 'Controller'; // ucfirst() function is used to convert the first character of a string to uppercase; e.g., StudentController
$controllerObj = new $controllerName($database); // used to create an instance of the controller class; e.g., new StudentController($database) creates an instance of the StudentController class of the controller class.
$actionMethod = $action . 'Action'; // e.g., listAction, addAction, editAction, deleteAction, viewAction

// Call the action method on the controller object
// Pass id if available, otherwise null
$controllerObj->$actionMethod($_GET['id'] ?? null);
