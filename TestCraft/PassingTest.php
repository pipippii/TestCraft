<?php
    include_once  'Db.php';
    session_start();

    $id = (int) $_GET['id'];
    if ($id < 1) {
        header ('location: ListTests.php');
    }

    $testId = $id;
    if (!isset($_SESSION['test_id']) || $_SESSION['test_id'] != $testId) {
        $_SESSION['test_id'] = $testId;
        $_SESSION['test_score'] = 0;
    }

    $res = $db->query("SELECT * FROM tests WHERE id = {$testId}");
    $row = $res->fetch();
    $testTitle = $row['title'];

    $questionNum = (int) $_POST['q'];
    if (empty($questionNum)) {
        $questionNum = 0;
    }
    $questionNum++;
    $questionStart = $questionNum - 1;

    $res = $db->query("SELECT count(*) AS count FROM questions WHERE test_id = {$testId}");
    $row = $res->fetch();
    $questionCount = $row['count'];

    $answerId = $_POST['answer_id'];
    $answerText = $_POST['answer_text'];
    if (!empty($answerId)) {
        if (empty($answerText)) {
            if (is_array($answerId)) {
                foreach ($answerId as $id) {
                    $res = $db->query("SELECT * FROM answers WHERE id = {$id}");
                    $row = $res->fetch();
                    $score = $row['score'];
                    $_SESSION['test_score'] += $score;
                }
            } else {
                $res = $db->query("SELECT * FROM answers WHERE id = {$answerId}");
                $row = $res->fetch();
                $score = $row['score'];
                $_SESSION['test_score'] += $score;
            }
        } elseif (!empty($answerText)) {
            $res = $db->query("SELECT * FROM answers WHERE id = {$answerId}");
            $row = $res->fetch();
            $correctAnswer = $row['answer'];
            if ($answerText == $correctAnswer) {
                $score = $row['score'];
                $_SESSION['test_score'] += $score;
            }
        }
    }

    $showForm = 0;
    if ($questionCount >= $questionNum) {
        $showForm = 1;

        $res = $db->query("SELECT * FROM questions WHERE test_id = {$testId} LIMIT {$questionStart}, 1");
        $row = $res->fetch();
        $question = $row['question'];
        $questionId = $row['id'];

        $res = $db->query("SELECT * FROM questions WHERE test_id = {$testId} LIMIT {$questionStart}, 1");
        $row = $res->fetch();
        $picture = $row['picture'];
        $pictureId = $row['id'];

        $res = $db->query("SELECT * FROM answers WHERE question_id = {$questionId}");
        $answers = $res->fetchAll();

    } else {
        $score = $_SESSION['test_score'];

        $res = $db->query("SELECT * FROM results WHERE test_id = {$testId} AND score_min <= {$score} AND score_max >= {$score}");
        $row = $res->fetch();
        $result = $row['result'];

        $res = $db->query("SELECT SUM(score) AS score FROM answers WHERE question_id IN (SELECT id FROM questions WHERE test_id = {$testId})");
        $sumMaxScore = $res->fetch()['score'];

        $_SESSION['test_score'] = 0;
    }
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&family=Manrope:wght@500&display=swap" rel="stylesheet">
    <title>Конструктор тестов</title>
    <link rel="stylesheet" href="css/app.css">
</head>
<body>

    <?php
            require_once __DIR__ . '/Header.php';
    ?>

    <div class="container"> 
        <?php if ($showForm) { ?>
            <form action="PassingTest.php?id=<?php echo $testId; ?>" method="post">
                <input type="hidden" name="q" value="<?php echo $questionNum; ?>">
                
                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="<?php echo ($questionNum / $questionCount) * 100; ?>" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar" style="width: <?php echo ($questionNum / $questionCount) * 100; ?>%"></div>
                </div>

                <p>Вопрос <?php echo $questionNum . ' из ' . $questionCount; ?></p>
                


                <div class="card" style="width: 40rem; margin: 0 auto;">
                    <h5 class="card-title mt-3" style="margin-left:20px;"><?php echo $question; ?></h5>
                    <?php 
                        if ($picture) {
                            echo '<img class="card-img-top" src="'.$picture.'" alt="Card image cap">';
                        }
                    ?>
                        <div class="card-body">
                                <?php foreach ($answers AS $answer) { ?>
                                    <div class="form-check mt-3">
                                    <?php
                                        $res = $db->query("SELECT flag FROM questions WHERE test_id = {$testId} LIMIT {$questionStart}, 1");
                                        $row = $res->fetch();
                                        $questionFlag = $row['flag'];

                                        // Определение типа вопроса и вывод соответствующего элемента формы
                                        if ($questionFlag === 'radio') {
                                            echo '<input class="form-check-input" type="radio" name="answer_id" required value="' . $answer['id'] . '"> ' . $answer['answer'];
                                        } elseif ($questionFlag === 'checkbox') {
                                            echo '<input class="form-check-input" type="checkbox" name="answer_id[]" value="' . $answer['id'] . '"> ' . $answer['answer'];
                                        } elseif ($questionFlag === 'text') {
                                            echo '<input class="form-control" type="text" name="answer_text">';
                                            echo '<input class="form-control" type="hidden" name="answer_id" value="' . $answer['id'] . '">';
                                        }
                                    ?>
                                    </div>
                                <?php } ?>
                                <?php if ($questionCount == $questionNum) { ?>
                                    <button type="submit" class="btn btn-success mt-3">Получить результат</button>
                                <?php } else { ?>
                                    <button type="submit" class="btn btn-primary mt-3">Дальше</button>
                            <?php } ?>
                        </div>
                </div>

                
            </form>
        <?php } else { ?>
                            <div class="card" style="width: 40rem; margin: 0 auto;">
                            <h3 class="mt-3 ml-3" style="margin-left:10px;">Ваш результат</h3>
                            <?php if ($score == 0) { ?>
                                <label for="title" class="form-label">Вы не смогли пройти тест</label>
                            <?php } else { ?>
                            <div class="d-flex justife-content-center w-100 flex-column align-items-center">
                            <div class="pie animate no-round" style="--p:<?php echo round(($score / $sumMaxScore) * 100); ?>;--c:orange;"> <span><?php echo round(($score / $sumMaxScore) * 100); ?>%</span></div>
                            <?php } ?>
                            <div class="my-3">
                            <div>
                            <?php echo $result; ?>
                            </div>
                            <div>
                            <?php echo "Набрано баллов: " .$score;?>
                            </div>
                            </div>
                            <?php
                                include_once  'Db.php';
                                session_start();
                                
                                $users_id = $_SESSION['user']['id'];
                                $db->query("INSERT INTO user_result (users_id, test_id, score, max_score) VALUES ($users_id, $testId, $score, $sumMaxScore)"); 
                            ?>
                            </div>
                            </div>
        <?php } ?>
    </div>
    <div class="overlay" id="overlay">
        <?php include_once __DIR__ . '/ActionRegister.php'?>
    </div>
</body>
</html>