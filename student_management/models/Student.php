<?php
class Student
{
    private $db; // private used to restrict access to the property within the class only

    public function __construct($database) // __construct is a special method that is automatically called when an object of the class is created. It is typically used to initialize properties or perform setup tasks.
    {
        $this->db = $database;
    }

    // view all students
    public function getAllStudents()
    {
        // Query database and return all students
        $stmt = $this->db->query('SELECT id, name, email FROM students ORDER BY id ASC');
        // $this refers to the current object instance
        // ASC means ascending order
        return $stmt->fetchAll();
        // fetchAll() used to fetch all results from a PDO(PHP Data Objects) statement as an array
    }

    // view one student by id
    public function getStudentById($id)
    {
        // Fetch specific student data
        $stmt = $this->db->prepare('SELECT id, name, email FROM students WHERE id = :id'); // : is a named placeholder in a SQL query, used in prepared statements to bind values securely and prevent SQL injection attacks.
        // prepare() is used to prepare an SQL statement for execution
        $stmt->execute([':id' => $id]); // execute() is used to execute a prepared statement
        return $stmt->fetch(); // returning a single record based on id
    }

    // add a new student
    public function addStudent($data)
    {
        // Insert new student record (very basic example)
        $stmt = $this->db->prepare('INSERT INTO students (name, email) VALUES (:name, :email)');
        return $stmt->execute([
            ':name' => $data['name'] ?? '', // The null coalescing operator (??) is used to check if a variable is set and not null. If it is not set or is null, it returns the value on its right side.
            ':email' => $data['email'] ?? '',
        ]);
    }

    // update an existing student by id
    public function updateStudent($id, $data)
    {
        // Update an existing student record
        $stmt = $this->db->prepare('UPDATE students SET name = :name, email = :email WHERE id = :id');
        return $stmt->execute([
            ':name' => $data['name'] ?? '', // : is a named placeholder in a SQL query, used in prepared statements to bind values securely and prevent SQL injection attacks.
            ':email' => $data['email'] ?? '',
            ':id' => $id,
        ]);
    }

    // delete a student by id
    public function deleteStudent($id)
    {
        // Delete a student by id
        $stmt = $this->db->prepare('DELETE FROM students WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}
