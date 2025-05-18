<?php
$dir = 'image/';
$files = scandir($dir);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Герои Dota 2</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }
        header, footer {
            background-color: #444;
            color: white;
            padding: 15px;
            text-align: center;
        }
        nav {
            background-color: #eee;
            padding: 10px;
            text-align: center;
        }
        nav a {
            margin: 0 10px;
            color: #333;
            text-decoration: none;
            font-weight: bold;
        }
        .gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            padding: 20px;
            justify-content: center;
        }
        .gallery img {
            width: 200px;
            height: 150px;
            object-fit: cover;
            border: 2px solid #ccc;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<header>
    <h1>Герои Dota 2</h1>
</header>

<nav>
    <a href="#">Главная</a>
    <a href="#">О нас</a>
    <a href="#">Контакты</a>
    <a href="#">Галерея</a>
</nav>

<div class="gallery">
    <?php
    if ($files !== false) {
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                $path = $dir . $file;
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                if (strtolower($ext) === 'jpg') {
                    echo "<img src=\"$path\" alt=\"image\">";
                }
            }
        }
    } else {
        echo "<p>Не удалось прочитать содержимое папки.</p>";
    }
    ?>
</div>

<footer>
    <p>&copy; <?php echo date("Y"); ?> USM</p>
</footer>

</body>
</html>