<?php
    session_start();
    $dsn = 'mysql:host=localhost; dbname=school';
    $user = 'root';
    $pass = '';
    
    try{
        $pdo = new PDO($dsn, $user, $pass);
    }catch(PDOException $e){
        echo 'connection error! ' .$e->getMessage();
    }


?>