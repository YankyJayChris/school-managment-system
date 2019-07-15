<?php
    include('include/header.php');
    include('include/sidebar.php');
    include('data/subject_model.php');
    include('data/student_model.php');
    $mysubject = $subject->getallsubject($id); 
    $classid = isset($_GET['classid']) ? $_GET['classid'] : null;    
    $search = isset($_POST['search']) ? $_POST['search'] : null;    
    if(isset($_POST['search'])){
        $classid = $_POST['subject'];   
        $mystudent = $student->getstudentbysearch($classid,$search);
    }else{
        $mystudent = $student->getstudentbyclass($classid);
    }
?>
<div id="page-wrapper">

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
                    <form action="student.php?classid=<?php echo $classid?>" method="post">
                        <input type="text" class="form-control" name="search" placeholder="Search by ID or Name">
                        <select name="subject" class="form-control" required>
                            <option value="">Select Subject...</option>                            
                            <?php while($row = mysql_fetch_array($mysubject)): ?>
                                <option value="<?php echo $row['id']?>" <?php if($row['id']==$classid) echo 'selected'; ?>><?php echo $row['subject'];?></option>
                            <?php endwhile; ?>
                        </select>
                        <button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>                       
                        <a href="print.php?classid=<?php echo $classid; ?>" target="_blank"><button type="button" name="submit" class="btn btn-success"><i class="fa fa-print"></i> Print</button></a>            
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
                                <th class="text-center">Name</th>
                                <th class="text-center">Prelim</th>
                                <th class="text-center">Midterm</th>
                                <th class="text-center">Final</th>
                                <th class="text-center">FINAL GRADE</th>
                                <th class="text-center">Calculate</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php $c=1; ?>
                    <?php foreach($mystudent as $row): ?>
                        <tr>
                            <td><?php echo $c; ?></td>    
                            <td class="text-center"><?php echo $row['studid']; ?></td>    
                            <td class="text-center"><?php echo $row['lname'].', '.$row['fname']; ?></td>  
                            <?php $grade = $student->getstudentgrade($row['id'],$classid); ?>
                            <td class="text-center"><?php echo $grade['prelim'];?></td>    
                            <td class="text-center"><?php echo $grade['midterm'];?></td>    
                            <td class="text-center"><?php echo $grade['final'];?></td>    
                            <td class="text-center"><?php echo $grade['total'];?></td>    
                            <td class="text-center"><a href="calculate.php?studid=<?php echo $row['id']; ?>&classid=<?php echo $classid ?>" class="btn btn-primary"><i class="fa fa-gear fa-lg" title="calculate grade"></i></a></td>    
                        </tr>
                    <?php $c++; ?>
                    <?php endforeach; ?>
                    <?php if(!$mystudent): ?>
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
<!-- /#page-wrapper -->    
<?php include('include/footer.php');