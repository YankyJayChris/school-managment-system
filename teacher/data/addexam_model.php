<?php
    include('../../config.php');
    $tmp = $_SESSION['id'];
    $q = "select * from teachers where teacherid='$tmp'";
    $stmt1 = $pdo->prepare($q);
    $stmt1->execute();
    $result = $stmt1->fetch(PDO::FETCH_ASSOC);
    $teacherid = $result['teacherid'];
    echo $teacherid;
    $classid = $_POST['class'];
    $val = 'MBA-III-N-1-2018-2019-IT003';
    list($course1, $year1, $section1,$term1,$sy1,$sy2,$subject1) = explode("-", $classid);

    $subject = $subject1;
    $section = $section1;
    $examtype = $_POST['type'];
    $term = $term1;
    $examname = $_POST['examname'];
    $maxmarks = $_POST['maxmarks'];
    $sy = $sy1.'-'.$sy2;
    $year = $year1;
    $course = $course1;
    echo $subject;


    echo $q = "insert into exams(examname,subject,examtype,classid,course,year,section,term,teacherid,sy,maxmarks) values(:examname,:subject,:examtype,:classid,:course,:year,:section,:term,:teacherid,:sy,:maxmarks)";
    $stmt = $pdo->prepare($q);
    $stmt->execute([':examname' =>$examname,':subject' =>$subject,':examtype' =>$examtype,':classid' =>$classid,':course' => $course1,':year' => $year,':section' =>$section,':term' =>$term,':teacherid' =>$teacherid,':sy' =>$sy,':maxmarks' =>$maxmarks]);
    header('location:../addexam.php?r=added');

?>