<?php     
    include('config.php');
    $act = $_SESSION['id'].' logged out.';
    $date = date('m-d-Y h:i:s A');
    $query ="insert into log values(null,'$date','$act')";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    session_destroy();
    header('location:index.php');
?>