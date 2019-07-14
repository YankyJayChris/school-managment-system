<?php
    include('../../config.php');
    $studentid = $_POST['studid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $course = $_POST['course'];
    $sy = $_POST['sy_s'];
    $year= $_POST['year_s'];
    $section = $_POST['section_s'];
    echo $q = "insert into students(studentid,fname,lname,course,sy,section,year) values(:studentid,:fname,:lname,:course,:sy,:section,:year)";
    $stmt = $pdo->prepare($q);
    $stmt->execute([':studentid' =>$studentid,':fname' =>$fname,':lname' =>$lname,':course' =>$course,':sy' =>$sy,':section' => $section,':year' => $year]);
    header('location:../studentslist.php?r=added');

?>