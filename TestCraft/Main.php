<?php
    require_once __DIR__ . '/src/Function.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&family=Manrope:wght@500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="assets/app.js"></script>
    <title>Конструктор тестов</title>
</head>
<body>

    <?php
        require_once __DIR__ . '/Header.php';
    ?>

    <div class="center mt-4">
        <div class="center-text">
            <div class="text1">Конструктор онлайн-тестов</div>
            <div class="text2">Создавайте уникальные тесты всего за 5 минут</div>
            <div class="text2">в удобном конструкторе TestCraft! Простой и</div>
            <div class="text2">гибкий редактор, быстрое размещение,</div>
            <div class="text2">различные вопросы, встроенная статистика.</div>
            <?php if (checkIsAuth()) : ?>
                <a class="btn btn-primary mt-5" href="ListTests.php">Создать бесплатно</a>
            <?php else : ?>
                <a class="btn btn-primary mt-5" href="#loginModal" data-bs-toggle="modal" data-bs-target="#loginModal">Создать бесплатно</a>
            <?php endif; ?>
        </div>
        <img class="center-img" src="center.png" alt="">
    </div>
    <?php include_once __DIR__ . '/LoginModal.php'?>
    <?php include_once __DIR__ . '/RegisterModal.php'?>
</body>
</html>