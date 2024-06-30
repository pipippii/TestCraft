<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&family=Manrope:wght@500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="assets/app.js"></script>
    <title>Конструктор тестров</title>
</head>
<body>

    <?php
        require_once __DIR__ . '/Header.php';
    ?>

    <div style="margin-top: 100px; margin-left: 300px; margin-right: 1200px;">
        <div style="flex:1;">
            <form action="src/actions/AccessCode.php" method="post">
                <label for="code" class="form-label mb-4">Введите код доступа к тесту:</label>
                <input type="text" name="code" id="code" class="form-control">
                <button type="submit" class="btn btn-primary addAnswer mt-4">Пройти тест</button>
                <?php if(hasMessage('error')): ?>
                    <div class="notice error"><?php echo getMessage('error') ?></div>
                <?php endif; ?>
            </form>
        </div>
    </div>


    <?php include_once __DIR__ . '/LoginModal.php'?>
    <?php include_once __DIR__ . '/RegisterModal.php'?>
</body>
</html>