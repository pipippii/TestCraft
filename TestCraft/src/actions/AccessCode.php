<?php

require_once '../Function.php';

    include_once  '../../Db.php';
    session_start();

    $enteredCode = $_POST['code'];

    $sql = $db->query('SELECT id FROM tests WHERE access_code = "'.$enteredCode.'"');
    $result = $sql->fetch();

    /*if ($result['id']) {
        redirect('/PassingTest.php?id='.$result['id']);
    } else {
        setMessage('error', 'Неверный код доступа');
        redirect('/Passing.php');
    }*/


    if ($result['id']) { 
        $currentUserId = $_SESSION['user']['id']; 
        $testUserId = $db->query('SELECT users_id FROM tests WHERE id = ' . $result['id'])->fetch()['users_id'];
        $userResult = $db->query('SELECT users_id FROM user_result WHERE users_id = ' . $currentUserId . ' AND test_id = ' . $result['id'])->fetch()['users_id']; 
        if ($testUserId == $currentUserId || $userResult) { 
            setMessage('error', 'Тест уже был пройден или вы являетесь создателем теста.'); 
            redirect('/Passing.php'); 
        } 
        else {
            redirect('/PassingTest.php?id=' . $result['id']);
        }
    } else { 
        setMessage('error', 'Неверный код доступа');
        redirect('/Passing.php'); 
    } 






    /*if ($result['id']) {
        $currentUserId = $_SESSION['users_id'];
        $testUserId = $db->query('SELECT users_id FROM tests WHERE id = '.$result['id'])->fetchColumn(); 
        if ($testUserId == $currentUserId) { 
            setMessage('error', 'Нельзя пройти свой тест.'); 
            redirect('/Passing.php'); 
        } 
        redirect('/PassingTest.php?id='.$result['id']); 
    } else { 
        setMessage('error', 'Неверный код доступа'); redirect('/Passing.php'); 
    }*/
?>
