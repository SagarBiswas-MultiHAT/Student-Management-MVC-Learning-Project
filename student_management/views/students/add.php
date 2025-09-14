<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Add Student</title>
    <link rel="stylesheet" href="/student_management/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- this meta tag ensures proper rendering and touch zooming on mobile devices -->
</head>

<body>
    <div class="container">
        <h1>Add Student</h1>

        <?php if (!empty($error)): ?>
            <div class="message-error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
            <!-- 
            htmlspecialchars is used to prevent XSS attacks by escaping special characters.
            ENT_QUOTES ensures both single and double quotes are converted to HTML entities (e.g., ' → &#039;, " → &quot;).
            'UTF-8' specifies the character encoding to use:
                - Ensures multibyte characters (emojis, accented letters, non-Latin scripts) are handled correctly.
                - Prevents broken characters or misinterpretation.
            Always use 'UTF-8' if your app may handle international text or emojis.
            -->
        <?php endif; ?>

        <form class="form" method="post" action="index.php?controller=student&action=add">
            <div class="field">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8') : ''; ?>">
            </div>
            <div class="field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') : ''; ?>">
            </div>
            <div class="actions">
                <button class="btn btn-primary" type="submit">Save</button>
                <a class="btn btn-secondary" href="index.php?controller=student&action=list">Cancel</a>
            </div>
        </form>
    </div>
</body>

</html>