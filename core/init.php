<?php 
    include 'databese/connection.php';
    include 'classes/user.php';

    global $pdo;

    session_start();

    $getFromU = new User($pdo);

    define("BASE_URL", "http://localhost/recodemarks/");
?>