<?php
    include('../../config.php');
    $tmp = $_SESSION['id'];
    

    if(isset($_POST['submitmarks'])){
        $count =count($_POST['marksfield']);
        $examidid=$_POST['rowexamid'];
        echo $count;
        echo "Ok";
    
        $q = "select * from teachers where teacherid='$tmp'";
        $stmt1 = $pdo->prepare($q);
        $stmt1->execute();
        $result = $stmt1->fetch(PDO::FETCH_ASSOC);
        $teacherid = $result['teacherid'];
        echo $teacherid;

        
    $classid = $_POST['classid'];
    echo $classid;
    $val = 'MBA-III-N-1-2018-2019-IT003';
    list($subjectid, $year1, $section,$term,$sy1,$sy2,$subjectid) = explode("-", $classid);
    $examtype = $_POST['examtype'];
    $maxmarks = $_POST['maxmarks'];
    $examid = $_POST['examname'];
    $sy= "$sy1-$sy2";
    echo $sy;
    $count = count($_POST['studentid']);
    $studentid1 = $_POST['studentid'];
    $studentmarks1 = $_POST['marksfield'];



    // echo $studentid1;
    // echo $studentmarks1;
        $i;
        for($i=0; $i < count($studentid1); $i++){
            $studentid = $studentid1[$i];
            $studentmarks = $studentmarks1[$i];
            echo $studentid;
            echo $studentmarks;
            echo $subjectid;
            $q ="INSERT INTO marks (subjectid,examtype,classid,sy,year,term,examid,teacherid,studentid,marks, maxmarks) VALUE(:subjectid,:examtype,:classid,:sy,:year1,:term,:examid,:teacherid,:studentid,:studentmarks,:maxmarks)";
            $stmt = $pdo->prepare($q);
            $results = $stmt->execute([':subjectid' => $subjectid,':examtype' => $examtype,':classid' => $classid,':sy' => $sy,':year1' => $year1,':term' => $term,':examid' => $examid,':teacherid' => $teacherid,':studentid' => $studentid,':studentmarks' => $studentmarks,':maxmarks' => $maxmarks]);
 
        }

        if ($i == count($studentid1)){
            $one ='1';
            echo $one;
          $q5 =  "UPDATE `exams` SET `marksadded` =:one WHERE `exams`.`id` = :examidid";
          $stmt2 = $pdo->prepare($q5);
          $stmt2->execute([':examidid'=> $examidid, ':one'=>$one]);
          header("location:../editmarks.php?classid=$classid&examname=$examid&examid=$examid");
        }
    }
?>