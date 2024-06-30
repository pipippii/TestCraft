<?php

require_once __DIR__ . '/../Function.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    logout();
}

redirect('/Account.php');