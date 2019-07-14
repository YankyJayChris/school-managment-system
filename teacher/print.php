<?php
    error_reporting(0);
    include('../config.php');
    $id = $_SESSION['id'];
    $tmp = $_SESSION['id'];
    $q = "select * from teachers where teacherid='$tmp'";
    $stmt = $pdo->prepare($q);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $teacher = $result['fname'].' '.$result['lname'];

    
    
    $students= array();
    if(isset($_GET['classid'])){
        $classname= $_GET['classid'];
        list($course1, $year1, $section1,$term,$sy1,$sy2,$subjectid) = explode("-", $classname);
        $q1 = "select * from students where course='$course1' and section='$section1' and year='$year1' and sy='$sy1-$sy2'";
        $stmt1 = $pdo->prepare($q1);
        $stmt1->execute();
        $students = $stmt1->fetchall(PDO::FETCH_OBJ);
            
    }

    function getstudentgrades($studentid,$classname){

        $dsn = 'mysql:host=localhost; dbname=school';
        $user = 'root';
        $pass = '';
        
        try{
            $pdo = new PDO($dsn, $user, $pass);
        }catch(PDOException $e){
            echo 'connection error! ' .$e->getMessage();
        }

        $q2= "SELECT SUM(marks) AS marks FROM marks WHERE studentid= '$studentid' AND classid='$classname' AND examtype='Exam'";
        $stmt = $pdo->prepare($q2);
        $stmt->execute();
        $countE= $stmt->rowCount(); 
        $examsrow = $stmt->fetch(PDO::FETCH_ASSOC);
        if($countE > 0){
            $exams= $examsrow['marks'];
        }
        else{
            $exams= 0;
        }

        $q3= "SELECT SUM(marks) AS marks FROM marks WHERE studentid= '$studentid' AND classid='$classname' AND examtype='Quiz'";
        $stmt1 = $pdo->prepare($q3);
        $stmt1->execute();
        $countQ= $stmt1->rowCount();
        $quizrow = $stmt1->fetch(PDO::FETCH_ASSOC);

        if($countQ > 0){
            $quizs = $quizrow['marks'];
        }
        else{
            $quizs= 0;
        }

        $q4= "SELECT SUM(marks) AS marks FROM marks WHERE studentid= '$studentid' AND classid='$classname' AND examtype='Assignement'";
        $stmt2 = $pdo->prepare($q4);
        $stmt2->execute();
        $countA= $stmt2->rowCount();
        $assinrow = $stmt2->fetch(PDO::FETCH_ASSOC);
        if($countA > 0){
            $assig = $assinrow['marks'];
        }
        else{
            $assig = 0;
        }


        $q5= "SELECT * FROM marksseting";
        $stmt3 = $pdo->prepare($q5);
        $stmt3->execute();
        $markssetting = $stmt3->fetch(PDO::FETCH_ASSOC);
        $examseting = $markssetting['exam']/100;
        $quizseting = $markssetting['quiz']/100;
        $assinseting = $markssetting['assin']/100;

        if($exams == 0){
            $examGrade = 0;
        }
        else{
            
            $q6="SELECT SUM(maxmarks) AS maxmarks FROM exams WHERE classid='$classname' and examtype='Exam'";
            $stmt4 = $pdo->prepare($q6);
            $stmt4->execute();
            $maxmarksE = $stmt4->fetch(PDO::FETCH_ASSOC);
            $maxmarksEx= $maxmarksE['maxmarks'];
            $divEmarks=100/$maxmarksEx;

            $examGrade = ($exams*$divEmarks)*$examseting;
        }
        if($quizs == 0){
            $quizGrade=0;
        }
        else{
            
            $q7="SELECT SUM(maxmarks) AS maxmarks FROM exams WHERE classid='$classname' and examtype='Quiz'";
            $stmt5 = $pdo->prepare($q7);
            $stmt5->execute();
            $maxmarksQ = $stmt5->fetch(PDO::FETCH_ASSOC);
            $maxmarksQi= $maxmarksQ['maxmarks'];
            $divQmarks=100/$maxmarksQi;

            $quizGrade = ($quizs*$divQmarks)*$quizseting;
        }
        if($assig == 0){
            $assigGrade=0;
        }
        else{
            
            $q8="SELECT SUM(maxmarks) AS maxmarks FROM exams WHERE classid='$classname' and examtype='Assignement'";
            $stmt6 = $pdo->prepare($q8);
            $stmt6->execute();
            $maxmarksA = $stmt6->fetch(PDO::FETCH_ASSOC);
            $maxmarksAs= $maxmarksA['maxmarks'];
            $divAmarks=100/$maxmarksAs;

            $assigGrade = ($assig*$divAmarks)*$assinseting;
        }

        $data =array(
            'assignement' => round($assigGrade, 0),
            'quiz' => round($quizGrade, 0),
            'exam' => round($examGrade, 0),
            'repeat' => round($examGrade, 0)
        );
        
        return $data;
    }
?>
<!DOCTYPE html>
<html>
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Print Report</title>

    <!-- Bootstrap Core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        .wrapper {
            margin-top:20px !important;            
            border:1px solid #777;
            background:#fff;
            margin:0 auto;
            padding: 20px;
        }
        body {
            background:#ccc;   
        }
        img {
            max-height:150px;   
            max-width:150px;   
            margin-right:10px;
        }
        .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
            border-top: none !important;   
        }
        
    </style>
</head>
<body>
    <div class="container wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center">                    
                    <h3>Grade Sheet</h3> 
                    <hr />
                    
                    <table class="table">
                        <tr>
                            <td style="width:20%;text-align:left;"><strong>SUBJ CODE:</strong></td>
                            <td style="width:*;text-align:left;"><?php echo $subjectid;?></td>
                            <td style="width:10%;text-align:left;"><strong>DATE:</strong></td>
                            <td style="width:25%;text-align:left;"><?php echo date('F d, Y')?></td>
                        </tr>
                        <tr>
                            <td class="text-left"><strong>SECTION:</strong></td>
                            <td class="text-left"><?php if($section1 == "D"){ echo "Day";}elseif($section1 == "N"){echo "Night";}else{echo "Weekend";}?></td>
                            <td class="text-left"><strong>UNITS:</strong></td>
                            <td class="text-left"><?php $qs="select * from subject where code='$subjectid'";$stmt10 = $pdo->prepare($qs);$stmt10->execute();$subjectdata= $stmt10->fetch(PDO::FETCH_ASSOC); echo $subjectdata['units'];?></td>
                        </tr>
                        <tr>
                            <td class="text-left"><strong>SUBJ NAME:</strong></td>
                            <td class="text-left"><?php echo $subjectdata['title'];?></td>
                            <td class="text-left"><strong>S.Y :</strong></td>
                            <td class="text-left"><?php $sy= "$sy1-$sy2"; echo $sy ;?></td>
                        </tr>
                        <tr>
                            <td class="text-left"><strong>INSTRUCTOR:</strong></td>
                            <td class="text-left"><?php echo strtoupper($teacher);?></td>
                            <td class="text-left"><strong>COURSE:</strong></td>
                            <td class="text-left"><?php echo $course1;?></td>
                        </tr>
                    </table>                    
                </div>               
            </div>
        </div> 
        
        
        
        <div class="row">
            <div class="col-lg-12">                

                <div class="">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">Student's ID</th>
                                <th class="text-center">Assignement</th>
                                <th class="text-center">Quiz</th>
                                <th class="text-center">Exam</th>
                                <th class="text-center">FINAL GRADE</th>
                                <th class="text-center">Repeat</th>
                                <th class="text-center">REMARKS</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php $c=1; ?>
                    <?php foreach($students as $row): ?>
                        <tr>
                            <td><?php echo $c; ?></td>    
                            <td class="text-center"><?php echo $row->studentid; ?></td>     
                            <?php $grade = getstudentgrades($row->studentid,$classname); ?>
                            <td class="text-center"><?php echo $grade['assignement'];?></td>    
                            <td class="text-center"><?php echo $grade['quiz'];?></td>    
                            <td class="text-center"><?php echo $grade['exam'];?></td>    
                            <td class="text-center"><?php echo $grade['assignement'] + $grade['quiz'] + $grade['exam'];?></td>    
                            <td class="text-center"><?php echo $grade['total'];?></td>                                
                            <!-- <td class="text-center"><?php echo $grade['eqtotal'];?></td>  -->
                            <?php
                                $totalgrade= $grade['assignement'] + $grade['quiz'] + $grade['exam'];
                                if($totalgrade>=50){
                                    $remarks = 'PASSED';
                                    $class = 'text-success';
                                }else{
                                    $remarks = 'FAILED';
                                    $class = 'text-danger';   
                                }
                            ?>
                            <td class="text-center <?php echo $class;?>"><?php echo $remarks;?></td> 
                        </tr>
                    <?php $c++; ?>
                    <?php endforeach; ?>
                    <?php if(!$students): ?>
                        <tr><td colspan="8" class="text-center text-danger"><strong>*** No Result ***</strong></td></tr>
                    <?php endif; ?>
                        </tbody>
                    </table>
                </div>        
            </div>
        </div>
    </div>
    
</body>

</html>