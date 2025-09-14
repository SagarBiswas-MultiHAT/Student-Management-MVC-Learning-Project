<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Students</title>
    <link rel="stylesheet" href="/student_management/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- this meta tag ensures proper rendering and touch zooming on mobile devices -->
    <style>
        body {
            visibility: visible
                /* this line used to ensure the body is visible after loading */
        }
    </style>
    <script>
        document.documentElement.style.visibility = 'visible'; // this line ensures the entire HTML document is visible once the script runs
    </script>
</head>

<body>
    <div class="container">
        <h1>Student List</h1>
        <div class="actions-bar">
            <a class="btn btn-primary" href="index.php?controller=student&action=add">Add Student</a>
        </div>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            <!-- students is an array of student data; each student is an associative array with keys 'id', 'name', and 'email' -->
            <?php if (!empty($students) && is_array($students)): foreach ($students as $student): ?>
                <!--  -->
                    <tr>
                        <td><?php echo $student['id']; ?></td>
                        <td><?php echo $student['name']; ?></td>
                        <td><?php echo $student['email']; ?></td>
                        <td>
                            <a href="index.php?controller=student&action=view&id=<?php echo $student['id']; ?>">View</a>
                            <a href="index.php?controller=student&action=edit&id=<?php echo $student['id']; ?>">Edit</a>
                            <a href="index.php?controller=student&action=delete&id=<?php echo $student['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach;
            else: ?>
                <tr>
                    <td colspan="4">No students found.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>

</html>