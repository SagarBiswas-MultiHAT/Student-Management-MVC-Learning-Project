<?php
// Include configuration
require_once 'config/database.php';

// Get controller and action from URL (with defaults)
$controller = $_GET['controller'] ?? 'student'; // default = student
$action = $_GET['action'] ?? 'list';           // default = list

/* 
===============================================================================
 Purpose of this file: indexWithSafetyChecks.php
===============================================================================
 Acts as the Front Controller for the Student Management project.
 It routes requests to the correct controller and action, while applying 
 safety checks to avoid fatal PHP errors.

 Why safety checks?
 -----------------
 - Prevents raw "500 Internal Server Error" or "Class not found" messages.
 - Shows clear, custom error messages without exposing sensitive details.
 - Makes debugging easier for developers while still being user-friendly.

 Examples:
 ---------
 1) Missing controller file:
    URL: http://localhost/student_management/indexWithSafetyChecks.php?controller=foo
    Output: "Error: Controller file not found → controllers/fooController.php"

 2) Missing action method:
    URL: http://localhost/student_management/indexWithSafetyChecks.php?action=bar
    Output: "Error: Action method <b>barAction</b> not found in StudentController."

 Default behavior:
 -----------------
 - If no controller/action is provided in the URL, 
   it loads the StudentController → listAction().
===============================================================================
*/

// ---------------- SAFETY CHECKS ---------------- //

// Controller file path
$controllerFile = "controllers/{$controller}Controller.php";
// Model file path
$modelFile = "models/" . ucfirst($controller) . ".php";

// Check controller file exists
if (!file_exists($controllerFile)) {
        die("Error: Controller file not found → {$controllerFile}");
}
require_once $controllerFile;

// Check model file exists
if (!file_exists($modelFile)) {
        die("Error: Model file not found → {$modelFile}");
}
require_once $modelFile;

// Controller class name
$controllerName = ucfirst($controller) . 'Controller';

// Check class exists
if (!class_exists($controllerName)) {
        die("Error: Controller class <b>{$controllerName}</b> not found.");
}

// Create controller object
$controllerObj = new $controllerName($database);

// Action method
$actionMethod = $action . 'Action';

// Check method exists
if (!method_exists($controllerObj, $actionMethod)) {
        die("Error: Action method <b>{$actionMethod}</b> not found in {$controllerName}.");
}

// ---------------- EXECUTE REQUEST ---------------- //
$controllerObj->$actionMethod($_GET['id'] ?? null);
