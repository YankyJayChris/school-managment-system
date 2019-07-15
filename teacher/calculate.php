<?php
    include('include/header.php');
    include('include/sidebar.php');
    include('data/student_model.php');
    $classid = isset($_GET['classid']) ? $_GET['classid']:null;    
    $studid = isset($_GET['studid']) ? $_GET['studid']:null;    
    $studentgrade = $student->getstudentgrade($studid,$classid);
    $mystudent = $student->getstudentbyid($studid);
?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <small>Calculation</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                    </li>
                    <li>
                        <a href="subject.php">My Subject</a>
                    </li>
                    <li>
                        <a href="student.php?classid=<?php echo $classid?>">My Students</a>
                    </li>
                    <li class="active">
                        Calculate Grade
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

       <div class="row">
            <div class="col-lg-12">
                 <?php if(isset($_GET['status'])): ?>
                    <?php if($_GET['status'] == 1): ?>
                        <div class="alert alert-success">
                            <strong>Done!</strong>
                        </div>
                    <?php endif; ?>
                <?php endif;?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr class="bg-primary">
                            <td><strong>Student ID</strong></td>
                            <td><strong>Fullname</strong></td>
                            <td><strong>Prelim</strong></td>
                            <td><strong>Midterm</strong></td>
                            <td><strong>Final</strong></td>
                            <td><strong>FINAL GRADE</strong></td>
                            <td><strong>EQUIVALENT</strong></td>
                        </tr>
                        <?php foreach($mystudent as $row): ?>
                        <tr class="bg-info">
                            <td><?php echo $row['studid'];?></td>
                            <td><?php echo $row['lname'].', '.$row['fname'];?></td>
                            <td><?php echo $studentgrade['prelim'];?></td>
                            <td><?php echo $studentgrade['midterm'];?></td>
                            <td><?php echo $studentgrade['final'];?></td>
                            <td><?php echo $studentgrade['total'];?></td>
                            <td><?php echo $studentgrade['eqtotal'];?></td>
                        </tr>
                        <?php endforeach;?>
                        
                    </table>                    
                </div>               
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-bar-chart-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $studentgrade['prelim'];?></div>
                                    <div>PRELIM</div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form action="data/grade_model.php?term=1&studid=<?php echo $studid;?>&classid=<?php echo $classid; ?>" method="POST">
                                <div class="form-group">
                                    <lable><strong>Attendance</strong></lable><input type="number" min=50 max=100 class="form-control" value="<?php echo $studentgrade['att1'];?>" name="att1" />
                                </div>
                                
                                <div class="form-group">
                                    <lable><strong>Quiz</strong></lable><input type="number" min=50 max=100 class="form-control" value="<?php echo $studentgrade['quiz1'];?>" name="quiz1"/>
                                </div>
                                <div class="form-group">
                                    <lable><strong>Project</strong></lable><input type="number" min=50 max=100 class="form-control" value="<?php echo $studentgrade['project1'];?>" name="project1"/>
                                </div>
                                <div class="form-group">
                                    <lable><strong>Exam</strong></lable><input type="number" min=50 max=100 class="form-control" value="<?php echo $studentgrade['exam1'];?>" name="exam1"/>
                                </div>
                                <button type="submit" class="btn btn-success">Update Grade</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-bar-chart-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $studentgrade['midterm'];?></div>
                                    <div>MIDTERM</div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form action="data/grade_model.php?term=2&studid=<?php echo $studid;?>&classid=<?php echo $classid; ?>" method="POST">
                                <div class="form-group">
                                    <lable><strong>Attendance</strong></lable><input type="number" min=50 max=100 class="form-control" value="<?php echo $studentgrade['att2'];?>" name="att2" />
                                </div>
                                
                                <div class="form-group">
                                    <lable><strong>Quiz</strong></lable><input type="number" min=50 max=100 class="form-control" value="<?php echo $studentgrade['quiz2'];?>" name="quiz2"/>
                                </div>
                                <div class="form-group">
                                    <lable><strong>Project</strong></lable><input type="number" min=50 max=100 class="form-control" value="<?php echo $studentgrade['project2'];?>" name="project2"/>
                                </div>
                                <div class="form-group">
                                    <lable><strong>Exam</strong></lable><input type="number" min=50 max=100 class="form-control" value="<?php echo $studentgrade['exam2'];?>" name="exam2"/>
                                </div>
                                <button type="submit" class="btn btn-success">Update Grade</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-bar-chart-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $studentgrade['final'];?></div>
                                    <div>FINAL</div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form action="data/grade_model.php?term=3&studid=<?php echo $studid;?>&classid=<?php echo $classid; ?>" method="POST">
                                <div class="form-group">
                                    <lable><strong>Attendance</strong></lable><input type="number" min=50 max=100 class="form-control" value="<?php echo $studentgrade['att3'];?>" name="att3" />
                                </div>
                                
                                <div class="form-group">
                                    <lable><strong>Quiz</strong></lable><input type="number" min=50 max=100 class="form-control" value="<?php echo $studentgrade['quiz3'];?>" name="quiz3"/>
                                </div>
                                <div class="form-group">
                                    <lable><strong>Project</strong></lable><input type="number" min=50 max=100 class="form-control" value="<?php echo $studentgrade['project3'];?>" name="project3"/>
                                </div>
                                <div class="form-group">
                                    <lable><strong>Exam</strong></lable><input type="number" min=50 max=100 class="form-control" value="<?php echo $studentgrade['exam3'];?>" name="exam3"/>
                                </div>
                                <button type="submit" class="btn btn-success">Update Grade</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->        


    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->    
<?php include('include/footer.php');