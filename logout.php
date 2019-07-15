<?php     
    include('config.php');
    $act = $_SESSION['id'].' logged out.';
    $date = date('m-d-Y h:i:s A');
    mysql_query("insert into log values(null,'$date','$act')");
    session_destroy();
    header('location:index.php');
?>