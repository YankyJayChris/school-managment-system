<?php
    include('../../config.php');
    $teacherid = $_POST['teachid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    echo $q = "insert into teachers(teacherid,fname,lname) values(:teacherid,:fname,:lname)";
    $stmt = $pdo->prepare($q);
    $stmt->execute([':teacherid' =>$teacherid,':fname' =>$fname,':lname' =>$lname]);
    header('location:../teacherslist.php?r=added');

?>