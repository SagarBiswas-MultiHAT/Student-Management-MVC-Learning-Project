<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Delete Student</title>
    <link rel="stylesheet" href="/student_management/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
    <div class="container">
        <h1>Delete Student</h1>

        <?php if (!empty($error)): ?>
            <div class="message-error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>

        <?php if (!empty($student)): ?>
            <div class="card">
                <p>Are you sure you want to delete the following student?</p>
                <ul>
                    <li><strong>ID:</strong> <?php echo htmlspecialchars($student['id'], ENT_QUOTES, 'UTF-8'); ?></li>
                    <li><strong>Name:</strong> <?php echo htmlspecialchars($student['name'], ENT_QUOTES, 'UTF-8'); ?></li>
                    <li><strong>Email:</strong> <?php echo htmlspecialchars($student['email'], ENT_QUOTES, 'UTF-8'); ?></li>
                </ul>
                <form method="post" action="index.php?controller=student&action=delete&id=<?php echo (int)$student['id']; ?>">
                    <button class="btn btn-danger" type="submit">Yes, delete</button>
                    <a class="btn btn-secondary" href="index.php?controller=student&action=list">Cancel</a>
                </form>
            </div>
        <?php else: ?>
            <div class="card">
                <p>Student not found.</p>
                <p><a class="btn btn-secondary" href="index.php?controller=student&action=list">Back to list</a></p>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>