<?php
    include('include/header.php');
    include('include/sidebar.php');
    include('data/student_model.php');
    include('data/class_model.php');
    $search = isset($_POST['search']) ? $_POST['search']: null;
    $student = $student->getstudent($search);
    $studentsubject = $class->getstudentsubject();
    $classid = $_GET['classid'];
    
    $rc = mysql_query("select * from class where id=$classid");
    $rc = mysql_fetch_array($rc);
    $subject = $rc['subject'];

?>
<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <small>CLASS STUDENTS</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                    </li>
                    <li>
                        <a href="class.php">Class Info</a>
                    </li>
                    <li class="active">
                        Class Students (Subject: <?php echo $subject; ?>)
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="form-inline form-padding">
                    <form action="classstudent.php?classid=<?php echo $classid;?>" method="post">
                        <input type="text" class="form-control" name="search" placeholder="Search by ID # or Name..." required autofocus>
                        <button type="submit" name="submitsearch" class="btn btn-success"><i class="fa fa-search"></i> Search</button> 
                        <a href="classstudent.php?classid=<?php echo $classid;?>" class="btn btn-primary">Master List</a>
                    </form>
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">     
                <?php if($search){ ?>
                    
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = mysql_fetch_array($student)): ?>
                                <tr>
                                    <td><?php echo $row['studid']; ?></td>
                                    <td><?php echo $row['fname']; ?></td>
                                    <td><?php echo $row['lname']; ?></td>
                                    <td class="text-center"><a href="data/class_model.php?q=addstudent&studid=<?php echo $row['id']; ?>&classid=<?php echo $classid;?>" class="btn btn-warning">Add to class</a></td>     
                                </tr>
                                <?php endwhile;?>
                                <?php if(mysql_num_rows($student) < 1): ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-danger"><strong>*** NO RESULT ***</strong></td>
                                    </tr>
                                <?php endif;?>
                            </tbody>
                        </table>
                   
                <?php }else{ ?>
                        <?php if(isset($_GET['r'])): ?>
                            <?php if($_GET['r']=='success'){ ?>
                                <div class="alert alert-success">
                                    <strong>Successfull!</strong>
                                </div>
                            <?php }else if($_GET['r']=='duplicate'){ ?>
                                <div class="alert alert-warning">
                                    <strong>Student already on the list!</strong>
                                </div>
                            <?php } ?>
                        <?php endif;?>            
                        <table class="table table-striped">
                            <thead>
                                <th>Student ID</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th class="text-center">Remove</th>
                            </thead>
                            <tbody>
                                <?php foreach($studentsubject as $row): ?>
                                <tr>
                                    <td><?php echo $row['studid']; ?></td>
                                    <td><?php echo $row['fname']; ?></td>
                                    <td><?php echo $row['lname']; ?></td>
                                    <td class="text-center"><a href="data/class_model.php?q=removestudent&studid=<?php echo $row['id']; ?>&classid=<?php echo $classid;?>" class="confirmation"><i class="fa fa-times-circle fa-2x text-danger"></i></a></td>     
                                </tr>
                                <?php endforeach;?>
                                <?php if(!$studentsubject): ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-danger"><strong>*** EMPTY ***</strong></td>
                                    </tr>
                                <?php endif;?>
                            </tbody>
                        </table>                       
                    
                
                <?php } ?>
                    </div>
            </div>
        </div>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->    
<?php include('include/footer.php');