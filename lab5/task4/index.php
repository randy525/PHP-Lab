<?php
$name = '';
$answers = [];
$errors = [];
$result = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['username']);
    $answers['q1'] = $_POST['q1'] ?? '';
    $answers['q2'] = $_POST['q2'] ?? [];
    $answers['q3'] = $_POST['q3'] ?? '';

    // Проверка заполнения всех полей
    if (empty($name)) {
        $errors[] = "Введите имя.";
    }
    if (empty($answers['q1'])) {
        $errors[] = "Ответьте на вопрос 1.";
    }
    if (empty($answers['q2'])) {
        $errors[] = "Выберите хотя бы один вариант в вопросе 2.";
    }
    if (empty($answers['q3'])) {
        $errors[] = "Ответьте на вопрос 3.";
    }

    // Проверка результатов, если нет ошибок
    if (empty($errors)) {
        $score = 0;

        if ($answers['q1'] === 'b') $score++;
        if (in_array('a', $answers['q2']) && in_array('c', $answers['q2']) && count($answers['q2']) === 2) $score++;
        if ($answers['q3'] === 'c') $score++;

        $result = "Спасибо, <strong>" . htmlspecialchars($name) . "</strong>!<br>Вы набрали <strong>$score</strong> из 3 баллов.";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Тест</title>
    <style>
        body { font-family: sans-serif; max-width: 600px; margin: auto; }
        .error { color: red; }
        .result { margin-top: 20px; color: green; }
    </style>
</head>
<body>
    <h2>Тест по общим знаниям</h2>

    <form method="POST">
        <p>
            <label>Ваше имя:<br>
                <input type="text" name="username" value="<?= htmlspecialchars($name) ?>">
            </label>
        </p>

        <fieldset>
            <legend>1. Какая планета третья от Солнца?</legend>
            <label><input type="radio" name="q1" value="a" <?= ($answers['q1'] ?? '') === 'a' ? 'checked' : '' ?>> Венера</label><br>
            <label><input type="radio" name="q1" value="b" <?= ($answers['q1'] ?? '') === 'b' ? 'checked' : '' ?>> Земля</label><br>
            <label><input type="radio" name="q1" value="c" <?= ($answers['q1'] ?? '') === 'c' ? 'checked' : '' ?>> Марс</label>
        </fieldset>

        <fieldset>
            <legend>2. Выберите языки программирования (множ. выбор)</legend>
            <label><input type="checkbox" name="q2[]" value="a" <?= in_array('a', $answers['q2'] ?? []) ? 'checked' : '' ?>> Python</label><br>
            <label><input type="checkbox" name="q2[]" value="b" <?= in_array('b', $answers['q2'] ?? []) ? 'checked' : '' ?>> HTML</label><br>
            <label><input type="checkbox" name="q2[]" value="c" <?= in_array('c', $answers['q2'] ?? []) ? 'checked' : '' ?>> Java</label>
        </fieldset>

        <fieldset>
            <legend>3. Столица Франции:</legend>
            <label><input type="radio" name="q3" value="a" <?= ($answers['q3'] ?? '') === 'a' ? 'checked' : '' ?>> Берлин</label><br>
            <label><input type="radio" name="q3" value="b" <?= ($answers['q3'] ?? '') === 'b' ? 'checked' : '' ?>> Мадрид</label><br>
            <label><input type="radio" name="q3" value="c" <?= ($answers['q3'] ?? '') === 'c' ? 'checked' : '' ?>> Париж</label>
        </fieldset>

        <p><input type="submit" value="Отправить"></p>
    </form>

    <?php if (!empty($errors)): ?>
        <div class="error">
            <ul>
                <?php foreach ($errors as $e): ?>
                    <li><?= htmlspecialchars($e) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php elseif ($result): ?>
        <div class="result"><?= $result ?></div>
    <?php endif; ?>
</body>
</html>
