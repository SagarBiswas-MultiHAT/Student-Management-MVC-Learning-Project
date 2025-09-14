<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Student Details</title>
    <link rel="stylesheet" href="/student_management/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
    <div class="container">
        <h1>Student Details</h1>
        <?php if (!empty($student)): ?>
            <div class="card">
                <p><strong>ID:</strong> <?php echo htmlspecialchars($student['id'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p><strong>Name:</strong> <?php echo htmlspecialchars($student['name'], ENT_QUOTES, 'UTF-8'); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($student['email'], ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
        <?php else: ?>
            <div class="card">
                <p>Student not found.</p>
            </div>
        <?php endif; ?>
        <p style="margin-top:12px;">
            <a class="btn btn-secondary" href="index.php?controller=student&action=list">Back to list</a>
            <a class="btn btn-primary" href="index.php?controller=student&action=edit&id=<?php echo isset($student['id']) ? (int)$student['id'] : ''; ?>">Edit</a>
            <a class="btn btn-danger" href="index.php?controller=student&action=delete&id=<?php echo isset($student['id']) ? (int)$student['id'] : ''; ?>">Delete</a>
        </p>
    </div>
</body>

</html>