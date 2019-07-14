<?php
    $page= 'addmarks';
    include('include/header.php');
    include('include/navbar.php');

    $examname1 = "";
    $classname1= "";
    $section1 = "";
    $subject1 = "";
    $examtype1 = "";
    $sy1 = "";
    $year1= "";
    $course1= "";
    $maxmarks1 = ""; 
    $error = "";
    $students = array();
    $add= "";

    
    if (isset($_GET['examname'])){
        $examid= $_GET['examid'];
        $examname1 = $_GET['examname'];
        $r = "select * from exams where examname='$examname1' and id=$examid";
        $stmt5 = $pdo->prepare($r);
        $stmt5->execute();
        $setings = $stmt5->fetch(PDO::FETCH_ASSOC);
        $classname1= $setings['classid'];
        $examname1= $setings['examname'];
        $course1= $setings['course'];
        $section1 = $setings['section'];
        $subject1 = $setings['subject'];
        $examtype1 = $setings['examtype'];
        $sy1 = $setings['sy'];
        $maxmarks1 = $setings['maxmarks'];
        $year1 = $setings['year'];

            $q2= "SELECT * From marks where subjectid='$course1' and classid='$classname1' and year='$year1' and sy='$sy1' and examtype='$examtype1' and examid='$examname1' ";
            $stmt8 = $pdo->prepare($q2);
            $stmt8->execute();
            $students = $stmt8->fetchall(PDO::FETCH_OBJ);
            $rowcount = $stmt8->rowCount();
            if($rowcount > 0){
                header("location:../teacher/editmarks.php?classid=$classname1&examname=$examname1");
            }else{

                $r2 = "select * from students where course='$course1' and section='$section1' and year='$year1' and sy='$sy1'";
                $stmt7 = $pdo->prepare($r2);
                $stmt7->execute();
                $students = $stmt7->fetchall(PDO::FETCH_OBJ);
                $students; 
            } 
    

     }else{
        $error ="select exam";
     }

     if(isset($_POST['getseting'])){

        $examid = $_POST['examname'];

        $r = "select * from exams where id='$examid'";
        $stmt6 = $pdo->prepare($r);
        $stmt6->execute();
        $setings = $stmt6->fetch(PDO::FETCH_ASSOC);
        $classname1= $setings['classid'];
        $examname1= $setings['examname'];
        $course1= $setings['course'];
        $section1 = $setings['section'];
        $subject1 = $setings['subject'];
        $examtype1 = $setings['examtype'];
        $sy1 = $setings['sy'];
        $maxmarks1 = $setings['maxmarks'];
        $year1 = $setings['year'];
        $rowexamid= $setings['id'];

            $q2= "SELECT * From marks where subjectid='$course1' and classid='$classname1' and year='$year1' and sy='$sy1' and examtype='$examtype1' and examid='$examname1' ";
            $stmt8 = $pdo->prepare($q2);
            $stmt8->execute();
            $students = $stmt8->fetchall(PDO::FETCH_OBJ);
            $rowcount = $stmt8->rowCount();
            if($rowcount > 0){
                header("location:../teacher/editmarks.php?classid=$classname1&examname=$examname1&examid=$rowexamid");
            }else{
                $q2 = "select * from students where course='$course1' and section='$section1' and year='$year1' and sy='$sy1'";
                $stmt7 = $pdo->prepare($q2);
                $stmt7->execute();
                $students = $stmt7->fetchall(PDO::FETCH_OBJ);
                // echo $students; 
                $add= ""; 
            }
     }
     else{
         $error ="select exam";
     }

     if(isset($_POST['getstudents'])){
        $classname1 = $_POST['classname'];
        // $val = 'MBA-III-N-1-2018-2019-IT003';
        list($course1, $year1, $section1,$term1,$sy1,$sy2,$subject1) = explode("-", $classname1);

        $q2= "SELECT * From marks where subjectid='$course1' and classid='$classname1' and year='$year1' and sy='$sy1-$sy2' and examtype='$examtype1' and examid='$examname1' ";
        $stmt8 = $pdo->prepare($q2);
        $stmt8->execute();
        $students = $stmt8->fetchall(PDO::FETCH_OBJ);
        $rowcount = $stmt8->rowCount();
        if($rowcount > 0){
            header("location:../teacher/editmarks.php?classid=$classname1&examname=$examname1&examid=$rowexamid");
        }else{
            $r2 = "select * from students where course='$course1' and section='$section1' and year='$year1' and sy='$sy1-$sy2'";
            $stmt7 = $pdo->prepare($r2);
            $stmt7->execute();
            $students = $stmt7->fetchall(PDO::FETCH_OBJ);
            echo $students;
        }
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
                                <small>ADD Marks</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                                </li>
                                <li class="active">
                                    Marks
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-inline form-padding">
                                <form method="post">
                                    <select name="examname" class="form-control" required>
                                        <option value="">Select Exam...</option>
                                        <?php 
                                            $tmp = $_SESSION['id'];
                                            $q = "select * from teachers where teacherid='$tmp'";
                                            $stmt = $pdo->prepare($q);
                                            $stmt->execute();
                                            $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                            $teacherid = $result['teacherid'];

                                            $r = "select * from exams where teacherid='$teacherid' ORDER BY id DESC";
                                            $stmt = $pdo->prepare($r);
                                            $stmt->execute();
                                            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                                    extract($row);
                                    
                                            echo "<option value='$id'>$examname ($classid)</option>";}
                                        ?>

                                    </select>
                                    <input class="btn btn-primary" name="getseting"  value="Search" type="submit">
                                   
                                </form>
                            </div>
                            <div class="form-inline form-padding">
                                <form method="post">

                                    <h3>Setings</h3>
                                    <?php
                                     echo '<input type="text" class="form-control" style="width:300px" readonly value= "Class Name: '.$classname1.'" name="classname" placeholder="Class..."> 
                                     <input type="text" class="form-control" style="width:200px" readonly value= "Exam Name: '.$examname1.'" name="search" placeholder="Exam Name...">
                                     <input type="text" class="form-control" style="width:200px" readonly value= "Maximum Marks: '.$maxmarks1.'" name="search" placeholder="Max marks...">
                                     <input type="text" class="form-control" style="width:200px" readonly value= "Type : '.$examtype1.'" name="search" placeholder="Max marks...">';
                                    ?>
                        
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--/.row -->
                    <hr />   
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if(isset($_GET['r'])): ?>
                                <?php
                                    $add = $_GET['r'];
                                    if($r=='added'){
                                        $classs='success';   
                                    }else if($add=='updated'){
                                        $classs='info';   
                                    }else if($add=='deleted'){
                                        $classs='danger';   
                                    }else{
                                        $classs='hide';
                                    }
                                ?>
                                <div class="alert alert-<?php echo $classs?> <?php echo $classs; ?>">
                                    <strong>Class info successfully <?php echo $add; ?>!</strong>    
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            
                            <div class="table-responsive">
                            <form action="data/addmarks_model.php" method="POST">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th >#</th>
                                            <th class="text-center" style="width:400px">Student ID</th>
                                            <th class="text-center">Marks</th>
                                            <!-- <th class="text-center">Action</th> -->

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $c = 1; ?>
                                        <?php  foreach($students as $row): ?>                   
                                            <tr>
                                                <td><?php echo $c;?></td>                      
                                                <td class="text-center" ><input type= "text" name="studentid[]" readonly class="studentid form-control" value= "<?php echo $row->studentid;?>"></td>
                                                <td  class="text-center"><input id="marksfield"  name="marksfield[]" required class="studentmarks form-control" value="0" type="number" placeholder=" Maximum marks is <?php echo $maxmarks1; ?>" max="<?php echo $maxmarks1; ?>">
                                                
                                                </td>
                                                <!-- <td class="text-center">                                                                               
                                                    <a href="#" title="update class">Save</i></a>
                                                    <a href="#" title="delete class">view</i></a></td> -->
                                            </tr>
                                        <?php $c++; ?>
                                        <?php endforeach; ?>
                                        <?php if($students < 1): ?>
                                            <tr>
                                                <td colspan="5" class="bg-danger text-danger text-center">*** EMPTY ***</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                    
                                </table>
                                <div class="form-group">
                                        <input id="marksfield" style="width:200px" name="classid" required class="studentmarks form-control" value="<?php echo $classname1; ?>" type="hidden" placeholder=" <?php echo $classname1; ?>">
                                        <input id="marksfield" style="width:200px" name="examname" required class="studentmarks form-control" value="<?php echo $examname1; ?>" type="hidden" placeholder=" <?php echo $examname1; ?>">
                                        <input id="marksfield" style="width:200px" name="rowexamid" required class="studentmarks form-control" value="<?php echo $rowexamid; ?>" type="hidden" placeholder=" <?php echo $examname1; ?>">
                                        <input id="marksfield" style="width:200px" name="examtype" required class="studentmarks form-control" value="<?php echo $examtype1 ; ?>" type="hidden" placeholder=" <?php echo $examtype1; ?>">
                                        <input id="marksfield" style="width:200px" name="maxmarks" required class="studentmarks form-control" value="<?php echo $maxmarks1 ; ?>" type="hidden" placeholder=" <?php echo $$maxmarks1; ?>">
                                    <input id="submitmarks" name="submitmarks" class="btn btn-primary" value="Submit" type="submit">
                                </div>

                            </form>
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

<script>
// $(document).ready(function(){
//     $('#submitmarks').on('click', function(){
//         var studentid = [];
//         var studentmarks = [];
//         var 
//     });
// });

</script>
<?php include('include/footer.php'); ?>