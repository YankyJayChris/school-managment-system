<?php
    $page= 'student';
    include('include/header.php');
    include('include/navbar.php');
    $students= array();
    if(isset($_POST['classname'])){
        $classname= $_POST['classname'];
        list($course1, $year1, $section1,$term,$sy1,$sy2,$subjectid) = explode("-", $classname);
        $q1 = "select * from students where course='$course1' and section='$section1' and year='$year1' and sy='$sy1-$sy2'";
        $stmt1 = $pdo->prepare($q1);
        $stmt1->execute();
        $students = $stmt1->fetchall(PDO::FETCH_OBJ);
            
    }
    if(isset($_GET['classname'])){
        $classname= $_GET['classname'];
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
            'exam' => round($examGrade, 0)
        );
        
        return $data;
    }

?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
                <div class="card">
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header">
                                    <small>MY STUDENTS</small>
                                </h1>
                                <ol class="breadcrumb">
                                    <li>
                                        <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                                    </li>
                                    <li>
                                        <a href="subject.php">My Subjects</a>
                                    </li>
                                    <li class="active">
                                        Students
                                    </li>
                                </ol>
                            </div>
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-inline form-padding">
                                    <form method="post">
                                        <!-- <input type="text" class="form-control" name="search" placeholder="Search by ID or Name"> -->
                                        <select name="classname" class="form-control" required>
                                            <option value="">Select Subject...</option> 
                                            <?php 
                                                $tmp = $_SESSION['id'];
                                                $q = "select * from teachers where teacherid='$tmp'";
                                                $stmt = $pdo->prepare($q);
                                                $stmt->execute();
                                                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                                $teacherid = $result['teacherid'];
                                                    
                                                $r = "select * from class where teacherid='$teacherid' ORDER BY id DESC";
                                                $stmt = $pdo->prepare($r);
                                                $stmt->execute();
                                                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                                        extract($row);
                                        
                                                echo "<option value='$classid'>$classid</option>";}
                                            ?>                           

                                        </select>
                                        <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>                       
                                        <a href="print.php?classid=<?php echo $classname; ?>" target="_blank"><button type="button" name="submit" class="btn btn-success"><i class="fa fa-print"></i> Print</button></a>            
                                    </form>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-lg-12">                

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th class="text-center">Student ID</th>
                                                <th class="text-center">Assignement</th>
                                                <th class="text-center">Quiz</th>
                                                <th class="text-center">Exam</th>
                                                <th class="text-center">FINAL GRADE</th>
                                                <th class="text-center">Details</th>
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
                                                        <td class="text-center"><a href="calculate.php?studid=<?php echo $row->studentid; ?>&classid=<?php echo $classname ?>" class="btn btn-primary"><i class="fa fa-gear fa-lg" title="calculate grade"></i></a></td>    
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
                        <!-- /.container-fluid -->
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('include/footer.php'); ?>