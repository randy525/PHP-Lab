<?php

$name = $mail = $comment = '';
$agree = false;
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST['name']);
    $mail = trim($_POST['mail']);
    $comment = trim($_POST['comment']);
    $agree = isset($_POST['agree']);

    if (strlen($name) < 3 || strlen($name) > 20) {
        $errors[] = "Имя должно содержать от 3 до 20 символов.";
    }
    if (preg_match('/\d/', $name)) {
        $errors[] = "Имя не должно содержать цифры.";
    }

    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Некорректный адрес электронной почты.";
    }

    if (empty($comment)) {
        $errors[] = "Поле комментария обязательно для заполнения.";
    }

    if (!$agree) {
        $errors[] = "Вы должны согласиться с обработкой данных.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>#write-comment</title>
    <style>
        body { font-family: monospace; }
        .form-group { margin-bottom: 10px; }
        input, textarea { font-family: monospace; }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>
    <h2>#my-shop</h2>
    <h3>#write-comment</h3>

    <form method="POST" action="">
        <div class="form-group">
            <label>Name:
                <input type="text" name="name" value="<?= htmlspecialchars($name) ?>">
            </label>
        </div>
        <div class="form-group">
            <label>Mail:
                <input type="email" name="mail" value="<?= htmlspecialchars($mail) ?>">
            </label>
        </div>
        <div class="form-group">
            <label>Comment:<br>
                <textarea name="comment" rows="6" cols="40"><?= htmlspecialchars($comment) ?></textarea>
            </label>
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" name="agree" <?= $agree ? 'checked' : '' ?>>
                Do you agree with data processing?
            </label>
        </div>
        <div class="form-group">
            <input type="submit" value="Send">
        </div>
    </form>


    <?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
        <?php if (!empty($errors)): ?>
            <div class="error">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php else: ?>
            <div class="success">
                <p>Комментарий успешно отправлен!</p>
                <p><strong>Name:</strong> <?= htmlspecialchars($name) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($mail) ?></p>
                <p><strong>Comment:</strong> <?= nl2br(htmlspecialchars($comment)) ?></p>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
