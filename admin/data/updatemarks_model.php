<?php
    include('../../config.php');
    $tmp = $_SESSION['id'];
    

    if(isset($_POST['submitmarks'])){
        $count =count($_POST['studentmarks']);
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
    $examid = $_POST['examid'];
    $sy= "$sy1-$sy2";
    echo $sy;
    $count = count($_POST['studentid']);
    $studentid1 = $_POST['studentid'];
    $studentmarks1 = $_POST['studentmarks'];



    // echo $studentid1;
    // echo $studentmarks1;

        for($i=0; $i < count($studentid1); $i++){
            $studentid = $studentid1[$i];
            $studentmarks = $studentmarks1[$i];
            echo $studentid;
            echo $studentmarks;
            echo $subjectid;
            $q ="UPDATE `marks` SET `marks` =:studentmarks where studentid=:studentid and classid=:classid and examid=:examid and examtype=:examtype and teacherid=:teacherid";
            $stmt = $pdo->prepare($q);
            $results = $stmt->execute([':studentmarks' =>$studentmarks,':examtype' => $examtype,':classid' => $classid,':examid' => $examid,':teacherid' => $teacherid,':studentid' => $studentid]);
            
            header('location:../addmarks.php?r=added');
        }
    }
?>