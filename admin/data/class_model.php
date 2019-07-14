<?php
    include('../../config.php');
    $course = $_POST['course'];
    $year = $_POST['year'];
    $section = $_POST['section'];
    $term = $_POST['term'];
    $teacherid = $_POST['teacherid'];
    $subject = $_POST['subject'];
    $sy = $_POST['sy'];
    $dash ="-";
    $classid= "$course$dash$year$dash$section$dash$term$dash$sy$dash$subject";

    if(!empty($course) && !empty($year) && !empty($section) && !empty($term) && !empty($subject) && !empty($teacherid) && !empty($sy) ){

        echo $q = "insert into class(classid,course,year,section,term,subject,sy,teacherid) values(:classid,:course,:year,:section,:term,:subject,:sy,:teacherid)";
        $stmt = $pdo->prepare($q);
        $stmt->execute([':classid' =>$classid,':course' =>$course,':year' =>$year,':section' =>$section,':term' =>$term,':subject' =>$subject,':sy' =>$sy,':teacherid' =>$teacherid]);
        header('location:../class.php?r=added');
        $classid = $pdo->lastInsertId();

        $q1 = "insert into classstudents(studentid,classid) SELECT studentid,$classid FROM students WHERE course='$course' and section='$section' and sy='$sy and year='$year'";
        $stmt1 = $pdo->prepare($q);
        $stmt1->execute();
    }
    
   
?>