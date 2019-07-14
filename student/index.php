<?php 
    include('../config.php'); 
    $level = isset($_SESSION['level']) ? $_SESSION['level']: null;
    if($level == null){
        header('location:../index.php');
    }else if($level != 'student'){
        header('location:../'.$level.'');
    }
    $id = $_SESSION['id'];
    $q = "select * from students where studentid='$id'";
    $stmt = $pdo->prepare($q);
    $stmt->execute();
    if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $id = $row['id'];
        $studentid= $row['studentid'];
        $course= $row['course'];
        $section= $row['section'];
        $sy= $row['sy'];
        $year= $row['year'];

        $q1 = "select * from class where course='$course' and section='$section' and year='$year'";
        $stmt1 = $pdo->prepare($q1);
        $stmt1->execute();
        $classes = $stmt1->fetchall(PDO::FETCH_OBJ);

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

        $classname= $classname;
        list($course1, $year1, $section1,$term,$sy1,$sy2,$subjectid) = explode("-", $classname);
        $q9= "SELECT * FROM subject where code='$subjectid'";
        $stmt7 = $pdo->prepare($q9);
        $stmt7->execute();
        $subjectname = $stmt7->fetch(PDO::FETCH_ASSOC);
        $subjecttitle= $subjectname['title'];

        

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
            'subjectcode' =>$subjectid,
            'subjecttitle' =>$subjecttitle,
            'assignement' => round($assigGrade, 0),
            'quiz' => round($quizGrade, 0),
            'exam' => round($examGrade, 0)
        );
        
        return $data;
    }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>MARKS RECORDING System</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/font-awesome.min.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="mystyle.css" />
    

  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Online Grading System</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <div class="navbar-form navbar-right">
                <label class="text-primary">
                    Hi, <?php echo $_SESSION['name']; ?>&nbsp;&nbsp;
                </label>
                <a href="../logout.php"><button type="button" class="btn btn-success" name="submit">Logout</button></a>
                <a href="print.php?classid=<?php echo $classid; ?>" target="_blank"><button type="button" name="submit" class="btn btn-primary"><i class="fa fa-print"></i> Print</button></a>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#changepass">Change Password</button>
            </div>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <div class="container" style="margin-top:60px;">
      <!-- Example row of columns -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center">Report of Grades</h2>
            <div class="">
                <table class="table table-bordered">
                    <thead>
                        <tr class="alert alert-info">
                            <th class="text-center">Subject Code</th>
                            <th class="text-center">Subject Title</th>
                            <th class="text-center">Assignement</th>
                            <th class="text-center">Quiz</th>
                            <th class="text-center">Exam</th>
                            <th class="text-center">Final Grade</th>
                            <th class="text-center">Details</th>
                           <!-- <th class="text-center">Units</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($classes as $row): ?>
                            <tr>
                                <?php $grade = getstudentgrades($studentid,$row->classid); ?>
                                <td class="text-center"><?php echo $grade['subjectcode'];?></td>    
                                <td class="text-center"><?php echo $grade['subjecttitle'];?></td>
                                <td class="text-center"><?php echo $grade['assignement'];?></td>    
                                <td class="text-center"><?php echo $grade['quiz'];?></td>    
                                <td class="text-center"><?php echo $grade['exam'];?></td>    
                                <td class="text-center"><?php $finalgrade= $grade['assignement'] + $grade['quiz'] + $grade['exam']; echo round($finalgrade)?></td>   
                                <td class="text-center"><a href="calculate.php?studid=<?php echo $studentid; ?>&classid=<?php echo $row->classid; ?>" class="btn btn-primary">View</a></td>    
                            </tr>
                        
                        <?php endforeach; ?>
                        <?php if(!$classes): ?>
                            <tr><td colspan="8" class="text-center text-danger"><strong>*** No Result ***</strong></td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <h4 class="text-center text-danger">*** NOTHING FOLLOWS ***</h4>
            </div>
        </div>    
    </div>
    
      <!-- <div class="row">
        <div class="col-lg-4 gradeform">
            <div class="form_hover " style="background-color: #428BCA;">
                <p style="text-align: center; margin-top: 20px;">
                    <i class="fa fa-bar-chart-o" style="font-size: 147px;color:#fff;"></i>
                </p>
                
                <div class="header">
                    <div class="blur"></div>
                    <div class="header-text">
                        <div class="panel panel-success" style="height: 247px;">
                            <div class="panel-heading">
                                <h3 style="color: #428BCA;">Subject: <?php echo $row['subject'];?></h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered">
                                    <tr class="alert alert-danger">
                                        <th>Exam name</th>
                                        <th>subject</th>
                                        <th>type</th>
                                        <th>GRADE</th>
                                    </tr>                               
                                    <tr>
                                        <td>20</td>
                                        <td>50</td>
                                        <td>60</td>
                                        <td>70</td>
                                    </tr>
                                    <tr>
                                        <td>20</td>
                                        <td>50</td>
                                        <td>60</td>
                                        <td>70</td>
                                    </tr>
                                    <tr>
                                        <td>20</td>
                                        <td>50</td>
                                        <td>60</td>
                                        <td>70</td>
                                    </tr>
                                    <tr>
                                        <td>20</td>
                                        <td>50</td>
                                        <td>60</td>
                                        <td>70</td>
                                    </tr>
                                    <tr>
                                        <td>20</td>
                                        <td>50</td>
                                        <td>60</td>
                                        <td>70</td>
                                    </tr>
                                </table> 
                                <div class="form-group">
                                    
                                    <label>Teacher: chris</label><br />
                                    <label>Semester: 2st Term</label><br />
                                </div>
                       
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div> -->
      </div>
        
        
<!-- add modal for subject -->
<div class="modal fade" id="changepass" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Change Password</h3>
        </div>
        <div class="modal-body">
            <form action="password.php?q=changepassword&username=<?php echo $_SESSION['id'];?>" method="post">
                <div class="form-group">
                    <input type="password" class="form-control" name="current" placeholder="Current Password" />
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="new" placeholder="New Password" />
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="confirm" placeholder="Confirm Password" />
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Change</button>
            </form>
        </div>
    </div>
  </div>
</div>
        

      <hr>

      <footer>
        <p>&copy; WEC MARKS RECORDING</p>
      </footer>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>
