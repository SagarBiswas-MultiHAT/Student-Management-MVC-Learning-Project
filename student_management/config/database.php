<?php
// Super simple PDO connection for beginners

$host = 'localhost';
$db   = 'student_management';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';
/* 
$charset = 'utf8mb4';
- Supports all Unicode characters, including emojis, symbols, and multilingual text.
- Prevents "incorrect string value" errors when storing characters outside the Basic Multilingual Plane.
- Always prefer utf8mb4 for new projects to ensure full compatibility and future-proofing. 
*/

try {
    // Create the PDO instance (this will be used across the app)
    $database = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass);
    // Show errors as exceptions (helpful while learning)
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}
