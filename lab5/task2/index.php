<?php

$name = $_POST['name'] ?? '';
$age = $_POST['age'] ?? '';
$track = $_POST['track'] ?? '';
$newsletter = $_POST['newsletter'] ?? '';
$food = $_POST['food'] ?? '';
$submitted = $_SERVER['REQUEST_METHOD'] === 'POST';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация на конференцию</title>
</head>
<body>
    <h1>Форма регистрации на конференцию</h1>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        <p>
            <label>Имя:
                <input type="text" name="name" required value="<?php echo htmlspecialchars($name); ?>">
            </label>
        </p>

        <p>
            <label>Возраст:
                <input type="number" name="age" min="12" max="100" required value="<?php echo htmlspecialchars($age); ?>">
            </label>
        </p>

        <p>
            <label>Выберите направление (трек):</label><br>
            <select name="track" required>
                <option value="">-- выберите --</option>
                <option value="frontend" <?php if ($track === 'frontend') echo 'selected'; ?>>Frontend</option>
                <option value="backend" <?php if ($track === 'backend') echo 'selected'; ?>>Backend</option>
                <option value="data" <?php if ($track === 'data') echo 'selected'; ?>>Data Science</option>
            </select>
        </p>

        <p>
            <label>Питание:</label><br>
            <input type="radio" name="food" value="meat" <?php if ($food === 'meat') echo 'checked'; ?>> Обычное<br>
            <input type="radio" name="food" value="vegetarian" <?php if ($food === 'vegetarian') echo 'checked'; ?>> Вегетарианское<br>
        </p>

        <p>
            <label>
                <input type="checkbox" name="newsletter" value="yes" <?php if ($newsletter === 'yes') echo 'checked'; ?>>
                Подписаться на рассылку
            </label>
        </p>

        <input type="submit" value="Отправить">
    </form>

    <?php if ($submitted): ?>
        <hr>
        <h2>Результат регистрации:</h2>
        <p>Имя: <b><?php echo htmlspecialchars($name); ?></b></p>
        <p>Возраст: <b><?php echo htmlspecialchars($age); ?></b></p>
        <p>Выбранный трек: <b><?php echo htmlspecialchars($track); ?></b></p>
        <p>Тип питания: <b><?php echo htmlspecialchars($food); ?></b></p>
        <p>Подписка на новости: <b><?php echo $newsletter === 'yes' ? 'Да' : 'Нет'; ?></b></p>
    <?php endif; ?>
</body>
</html>
