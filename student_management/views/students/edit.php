<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Edit Student</title>
    <link rel="stylesheet" href="/student_management/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
    <div class="container">
        <h1>Edit Student</h1>

        <?php if (!empty($error)): ?>
            <div class="message-error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>

        <?php if (!empty($student)): ?>
            <form class="form" method="post" action="index.php?controller=student&action=edit&id=<?php echo (int)$student['id']; ?>">
                <div class="field">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($student['name'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>
                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($student['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>
                <div class="actions">
                    <button class="btn btn-primary" type="submit">Update</button>
                    <a class="btn btn-secondary" href="index.php?controller=student&action=list">Cancel</a>
                </div>
            </form>
        <?php else: ?>
            <div class="card">
                <p>Student not found.</p>
                <p><a class="btn btn-secondary" href="index.php?controller=student&action=list">Back to list</a></p>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>