<?php
    include_once 'Db.php';

    if (isset($_GET['id'])) {
        $testId = $_GET['id'];

        // Удаление вопросов
        $db->exec("DELETE FROM questions WHERE test_id = $testId");

        // Удаление ответов
        $db->exec("DELETE FROM answers WHERE question_id IN (SELECT id FROM questions WHERE test_id = $testId)");

        // Удаление результатов
        $db->exec("DELETE FROM results WHERE test_id = $testId");

        // Удаление самого теста
        $db->exec("DELETE FROM tests WHERE id = $testId");
    }

    header('Location: ListTests.php?do=ActionList');
?>