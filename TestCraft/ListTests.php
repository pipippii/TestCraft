<?php
    include_once  'Db.php';
    require_once __DIR__ . '/src/Function.php';

    session_start();
    
    $do = trim(strip_tags($_GET['do']));
    if ($do == 'save') {
        $title = trim($_POST['title']);
        $accessCode = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 10);

        $res = $db->prepare("INSERT IGNORE INTO tests (`title`, `users_id`, `access_code`) VALUES (:title, :users_id, :access_code)");
        $res->execute([
            ':title' => $title,
            ':users_id' => $_SESSION['user']['id'],
            ':access_code' => $accessCode,
        ]);
        $testId = $db->lastInsertId();

        $questionNum = 1;
        while (isset($_POST['question_' . $questionNum])) {
            $question = trim($_POST['question_' . $questionNum]);
            if (empty($question)) {
                continue;
            }

            $picturePath = null;
            $picture = $_FILES['picture_' . $questionNum] ?? null;

            if (!empty($picture) && $picture["size"]) {
                $picturePath = uploadFile($picture, 'picture');
            }

            $flag = $_POST['options-base_' . $questionNum]; 

            $res = $db->prepare("INSERT IGNORE INTO questions (`test_id`, `question`, `flag`, `picture`) VALUES (:test_id, :question, :flag, :picture)");
            $res->execute([
                ':test_id' => $testId,
                ':question' => $question,
                ':flag' => $flag,
                ':picture' => $picturePath,
            ]);
            $questionId = $db->lastInsertId();

            $answerNum = 1;
            while (isset($_POST['answer_text_' . $questionNum . '_' . $answerNum])) {
                $answer = trim($_POST['answer_text_' . $questionNum . '_' . $answerNum]);
                $score = trim($_POST['answer_score_' . $questionNum . '_' . $answerNum]);
                if (empty($answer)) {
                    continue;
                }

                $res = $db->prepare("INSERT IGNORE INTO answers (`question_id`, `answer`, `score`) 
                                    VALUES (:question_id, :answer, :score)");
                $res->execute([
                    ':question_id' => $questionId,
                    ':answer' => $answer,
                    ':score' => $score,
                ]);

                $answerNum++;
            }
            $questionNum++;
        }

        $resultNum = 1;
        while (isset($_POST['result_' . $resultNum])) {
            $result = trim($_POST['result_' . $resultNum]);
            $scoreMin = trim($_POST['result_score_min_' . $resultNum]);
            $scoreMax = trim($_POST['result_score_max_' . $resultNum]);

            $res = $db->prepare("INSERT IGNORE INTO results (`test_id`, `score_min`, `score_max`, `result`) 
                                    VALUES (:test_id, :score_min, :score_max, :result)");
            $res->execute([
                ':test_id' => $testId,
                ':score_min' => $scoreMin,
                ':score_max' => $scoreMax,
                ':result' => $result,
            ]);

            $resultNum++;
        }

        header ('Location: ListTests.php?do=ActionList');
    }

    if ($do != 'AddTest') {
        $do = 'ActionList';
    }
?>

<?php
// Проверяем, был ли отправлен запрос на удаление теста
if (isset($_GET['do']) && $_GET['do'] === 'DeleteTest' && isset($_GET['id'])) {
    $testId = $_GET['id'];
    
    // Выполняем удаление теста из базы данных
    $db->query("DELETE FROM tests WHERE id = $testId");
    $db->query("DELETE FROM questions WHERE test_id = $testId");
    $db->query("DELETE FROM answers WHERE question_id IN (SELECT id FROM questions WHERE test_id = $testId)");
    $db->query("DELETE FROM results WHERE test_id = $testId");

    // Перенаправляем пользователя обратно на страницу списка тестов
    header("Location: ListTests.php?do=ActionList");
    exit();
}
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/list.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&family=Manrope:wght@500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <title>Конструктор тестов</title>
</head>
<body>


    <?php
            require_once __DIR__ . '/Header.php';
    ?>

    <?php include_once 'inc/' . $do . '.php'; ?>
    <?php include_once 'inc/' . $do . '.php'; ?>

    <div class="overlay" id="overlay">
        <?php include_once __DIR__ . '/ActionRegister.php'?>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/app.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/app.js"></script>
</body>
</html>