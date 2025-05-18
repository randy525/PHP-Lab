<?php

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$review = $_POST['review'] ?? '';
$comment = $_POST['comment'] ?? '';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($name)) {
        $errors[] = "Имя обязательно.";
    }

    if (empty($email)) {
        $errors[] = "Email обязателен.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Неверный формат email.";
    }

    if (empty($comment)) {
        $errors[] = "Комментарий обязателен.";
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Форма отзыва</title>
</head>
<body>

<div class="form">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <fieldset>
            <legend>Оставьте отзыв!</legend>
            <div style="display: flex; flex-direction: column; gap: 10px;">
                <label>Имя:
                    <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" />
                </label>

                <label>Email:
                    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" />
                </label>

                <p><label>Оцените наш сервис!</label></p>
                <label><input type="radio" name="review" value="10" <?php if ($review == '10') echo 'checked'; ?>> Хорошо</label>
                <label><input type="radio" name="review" value="8" <?php if ($review == '8') echo 'checked'; ?>> Удовлетворительно</label>
                <label><input type="radio" name="review" value="5" <?php if ($review == '5') echo 'checked'; ?>> Плохо</label>

                <label>Ваш комментарий:
                    <textarea name="comment" cols="30" rows="5"><?php echo htmlspecialchars($comment); ?></textarea>
                </label>

                <div style="margin-top: 10px;">
                    <input type="submit" value="Отправить">
                    <input type="reset" value="Удалить">
                </div>
            </div>
        </fieldset>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
        <?php if (!empty($errors)): ?>
            <div style="color: red; margin-top: 20px;">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php else: ?>
            <div id="result" style="margin-top: 20px;">
                <p>✅ <strong>Форма успешно отправлена!</strong></p>
                <p>Ваше имя: <b><?php echo htmlspecialchars($name); ?></b></p>
                <p>Ваш e-mail: <b><?php echo htmlspecialchars($email); ?></b></p>
                <p>Оценка сервиса: <b><?php echo htmlspecialchars($review); ?></b></p>
                <p>Комментарий: <b><?php echo nl2br(htmlspecialchars($comment)); ?></b></p>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

</body>
</html>
